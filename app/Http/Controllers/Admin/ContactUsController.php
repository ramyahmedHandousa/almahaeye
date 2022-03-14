<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{

    public function index(Request $request)
    {
        $query = new ContactUs();

        if ($request->type == 'sender'){

            $my_message =   $query->whereNotNull('parent_id')->latest()->get();

        }elseif ($request->type == 'deleted'){

            $my_message =    $query->where('is_deleted',1 )->latest()->get();
        }else{

            $my_message =    $query->where('is_deleted',0 )->latest()->get();
        }

        $messageNotReadCount = ContactUs::whereNull('parent_id')->whereIsRead(0)->count();

        return view('admin.inbox.index', compact('my_message','messageNotReadCount'));
    }



    public function updateIsRead(Request $request){

        $support = ContactUs::find($request->id);
        $support->update([
            'is_read' => 1,
            'read_at' => now()
        ]);
    }


    public function updateIsDeleted(Request $request){

        $support = ContactUs::whereIn('id', $request->ids)->update([
            'is_deleted' => 1,
            'is_read' => 1
        ]);
        return response()->json([
            'status' => true,
            'message' => '  تم نقلها إالي صندوق المحذوفات ',
            'data' => $support

        ], 200);
    }


    public function removeAllMessages(Request $request){

        $support = ContactUs::whereIn('id', $request->ids)->get();
        $support->each->delete();
        return response()->json([
            'status' => true,
            'message' => ' تم مسح الرسائل نهائيا',
            'data' => $support

        ], 200);
    }



    public function store(Request $request)
    {
       $support = new ContactUs();
       $support->parent_id = $request->parentId ? : 0;
       $support->message = $request->message;
       $support->save();

        return response()->json([
            'status' => true,
            'message' => 'تم إراسل رسالتك بنجاح ',
            'data' => $support

        ], 200);
    }

}
