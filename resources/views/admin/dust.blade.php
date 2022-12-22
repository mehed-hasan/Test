// Crud for tag ---------------------------------------------------------
public function create_tag(){
    return view('/admin/create_tag');
}


public function insert_tag(Request $request){
    $today = Carbon::today();

    $request->validate([
       'tag_name' => 'required|max:255|unique:tags,tag_name',
   ]);

                               
   DB::table('tags')->insert([

    'tag_name' => $request->input('tag_name'),
    'created_at' => $today
   ]);


session()->flash('message', 'New tag successfully created.');
return redirect('/admin/create_tag');
}


public function tag_list(){

    $datas= DB::table('tags')->orderBy('id','desc')->get();
    return view('/admin/tag_list')->withDatas($datas);
}


public function delete_tag(Request $request){
    $id = $request->input('delete_id');
    DB::table('tags')->where('id',$id)->delete();
    session()->flash('message', 'tag deleted successfully .');
    return redirect('/admin/tag_list/');


}
