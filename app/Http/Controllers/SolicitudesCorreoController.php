<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\SolicitudesCorreo;
use Illuminate\Http\Request;

class SolicitudesCorreoController extends Controller
{
    public function index()
    {
        Mail::to('gonzariquelme66@gmail.com')->send(new SolicitudesCorreo('mails.solicitudAceptada'));
        Mail::to('dylanhughes028@gmail.com')->send(new SolicitudesCorreo('mails.solicitudAceptada'));

        return "mensaje enviado";

    }
}
