<?php

namespace App\Http\Controllers;

use App\Http\Middleware\JustNodeAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\NodePoint;
use App\Models\NodeStatsEntry;
use App\Models\User;

class NodeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['justNodeAdmin'])->except('getAllStats');
        $this->middleware('isSuperAdmin')->only('getAllStats','testExclusion', );
    }

    public function getNode(){
        $user = Auth::user();
        $node = $user->node;

        if(!$node) return redirect('node/new-node');

        $node_stats = NodeStatsEntry::where('node_id', $node->id)
                            ->orderBy('created_at', 'asc')
                            ->get();

        return view('node', compact('node', "node_stats"));
    }

    /**
     * Can only be accessed once if the user never added a node
     */
    public function newNode(){
        $user = Auth::user();
        $node = $user->node;

        if($node) return redirect('node');

        return view('node_add');
    }

    public function postNewNode(Request $request){
        $this->validateNode($request);

        $user = User::find(auth()->user()->id);

        $node_point = new NodePoint();
        $node_point->node_name = $request->node_name;
        $node_point->description = $request->description;
        $node_point->total_disk = $request->total_disk;
        $node_point->allocated_disk = $request->allocated_disk;
        $node_point->total_ram = $request->total_ram;
        $node_point->allocated_ram = $request->allocated_ram;
        $node_point->admin_id = $user->id;

        $node_point->save();
        $user->node_id = $node_point->id;
        $user->save();

        return redirect('/node');
    }

    public function addOrUpdateNode(Request $request){
        $url = $request->route()->uri();

        // error_log($url.url() ." url ---------------------");
        $max_ram_allocated = ($request->total_ram)*0.75;
        $max_disk_allocated = ($request->total_disk)*0.75;
        $max_total_ram = $request->total_disk*0.15;

        $validator = Validator::make($request->all(), [
        'node_name'=> 'required|max:120',
        'description'=> 'required|max:255',
        'total_disk'=> 'required',
        'total_ram'=> "required|lt:$max_total_ram",
        'allocated_disk'=> "required|lt:$max_disk_allocated",
        'allocated_ram'=> "required|lt:$max_ram_allocated",
        ]);       

        $this->validate($request, [],
                    ['allocated_disk.lt' => "max of 75%, $max_disk_allocated",
                    'allocated_ram.lt' => "max of 75%, $max_ram_allocated",
                    'total_ram.lt' => "max is 15% of disk, $max_total_ram ",
                ]);

        $redirect_url = $url == "node/new-node"? $url : "node";

        if($validator->fails()){
            return redirect($redirect_url)
                ->withInput()
                ->withErrors($validator);
        } 

        // $this->validateNode($request);
        error_log($url ."----------------------------");
        $is_new_add = $url == "node/new-node" ? 1 : 0;

        $user = User::find(auth()->user()->id);

        error_log($is_new_add ." new add val $url -------------------------------");

        $node_point = $is_new_add? new NodePoint() : NodePoint::find($user->node_id);

        $node_point->node_name = $request->node_name;
        $node_point->description = $request->description;
        $node_point->total_disk = $request->total_disk;
        $node_point->allocated_disk = $request->allocated_disk;
        $node_point->total_ram = $request->total_ram;
        $node_point->allocated_ram = $request->allocated_ram;
        
        if($is_new_add){
            $node_point->admin_id = $user->id;
            $node_point->save();
            $user->node_id = $node_point->id;
            $user->save();
        } else {
            $node_point->save();
        }

        return redirect('node');
    }

    public function newNodeStats(Request $request){
        error_log(" getNode -----------------------");
        // get node
        $node = User::find(auth()->user()->id)->node;
        if(!$node) return redirect('node/new-node');

        $validator = Validator::make($request->all(), [
            'ram_used'=> 'required|max:255',
            'disk_used'=> 'required',
        ]);

        if($validator->fails()){
            return redirect('/node')
                ->withInput()
                ->withErrors($validator);
        }

        $node_entry = new NodeStatsEntry();
        $node_entry->comment = $request->comment;
        $node_entry->ram_used = $request->ram_used;
        $node_entry->disk_used = $request->disk_used;
        $node_entry->node_id = $node->id;
        
        $node_entry->save();


        return redirect('/node');
    }

    public function getAllStats(){
        $node_stats = NodeStatsEntry::with('node')->paginate(10);
        // foreach($node_stats as $data) {
            // $name = $data['node_name'];
            // error_log("$name $data ------------------------");}
        return view('admin', compact('node_stats'));
    }

    public function deleteEntry(Request $request){
        NodeStatsEntry::findOrFail($request->route('id'))->delete();
        return redirect('/node');
    }

    private function validateNode(Request $request){
        $validator = Validator::make($request->all(), [
        'node_name'=> 'required|max:120',
        'description'=> 'required|max:255',
        'total_disk'=> 'required',
        'total_ram'=> 'required',
        'allocated_disk'=> 'required',
        'allocated_ram'=> 'required',
        ]);

        if($validator->fails()){
            return redirect($request->route())
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function testExclusion(){
        return dd('drop it');
    }
}
