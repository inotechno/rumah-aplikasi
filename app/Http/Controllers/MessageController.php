<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Mail\MessageReplyMail;
use App\Mail\MessageContactMail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index()
    {
        return view('message.index');
    }

    public function datatable(Request $request)
    {
        // $messages = Message::all();
        // return json_encode($messages);

        if ($request->ajax()) {
            $messages = Message::query();

            // dd($order);
            return DataTables::eloquent($messages)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a class="btn btn-warning btn-sm btn-icon" href="' . route('message.detail', $row->id) . '"><i class="bx bx-reply"></i>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function detail($id)
    {
        $message = Message::find($id);
        return view('message.detail', compact('message'));
    }

    public function reply(Request $request, $id)
    {
        $validate = $request->validate([
            'reply' => 'required',
        ]);

        $message = Message::find($id);
        $message->reply = $request->reply;

        // dd($message);
        try {
            Mail::to($message->email)->send(new MessageReplyMail($message));
            // Mail::failures()
            $msg = Message::find($id);
            $msg->update(['status' => 'dibalas']);
            $request->session()->flash('success', 'Email berhasil dikirim');
            return redirect()->route('message.index');
        } catch (\Throwable $th) {
            return back()->with('error', json_encode($th));
        }
    }

    public function contact(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
            'captcha' => 'required|captcha'
        ]);

        // dd($validate);
        try {
            // Mail::failures()
            // Message::create($validate);

            $message = Message::create([
                'no_antrian'  => date('dmYHis'),
                'name'  => $request->name,
                'email'  => $request->email,
                'subject'  => $request->subject,
                'message'  => $request->message,
                'status'    => 'diterima'
            ]);

            Mail::to($request->email)->send(new MessageContactMail($message));
            Mail::to('contact@rumahaplikasi.co.id')->send(new MessageContactMail($message));

            $request->session()->flash('success', 'Email berhasil dikirim');
            return redirect('/');
        } catch (\Throwable $th) {
            $request->session()->flash('error', json_encode($th));
            return redirect('/#contact');
        }
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
