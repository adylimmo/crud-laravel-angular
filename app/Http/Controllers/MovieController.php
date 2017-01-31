<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $client = new Client();
        $res = $client->request('GET', 'http://api.themoviedb.org/3/movie/top_rated?api_key=842c131a7fb77c69047d99e45188ccb7');
        $genre = $client->request('GET','https://api.themoviedb.org/3/genre/movie/list?api_key=842c131a7fb77c69047d99e45188ccb7');
        $datas = (string) $res->getBody();
        $datagenre = (string) $genre->getBody();
        $data = json_decode($datas, true);
        $genredata = json_decode($datagenre, true);
        //dd($genredata);
        return view('film.film', compact('data','genredata'));
    }
    
    public function lihat($id)
    {
        $client = new Client();
        $res = $client->request('GET', 'http://api.themoviedb.org/3/movie/'.$id.'?api_key=842c131a7fb77c69047d99e45188ccb7');
        $videonya = $client->request('GET','http://api.themoviedb.org/3/movie/'.$id.'/videos?api_key=842c131a7fb77c69047d99e45188ccb7');
        $datas = (string) $res->getBody();
        $datavid = (string) $videonya->getBody();
        $data = json_decode($datas, true);
        $videodata = json_decode($datavid, true);
        //dd($videodata);
        return view('film.nonton', compact('data','videodata'));
    }
}
