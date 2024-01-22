<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Item::all();
        //$categories=Category::all();
        return view('item.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('item.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        $image = $request->image;
        $newName = "gallery_".uniqid().".".$image->extension();
        $image -> storeAs("public/gallery",$newName);
        $item =new Item();
        $item->name=$request->name;
        $item->price=$request->price;
        $item->category_id=$request->category_id;
        $item->expire_date=$request->expire_date;
        $item->image=$newName;
        $item->save();
        return redirect()->route('item.index')->with('success','Item is created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('item.detail',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories=Category::all();
        return view('item.edit',compact('item','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        if($request->image){
            $image = $request->image;
            $newName = "gallery_".uniqid().".".$image->extension();
            $image -> storeAs("public/gallery",$newName);

            $item->name=$request->name;
            $item->price=$request->price;
            $item->category_id=$request->category_id;
            $item->expire_date=$request->expire_date;
            $item->image=$newName;
            $item->update();
        }
        $item->name=$request->name;
        $item->price=$request->price;
        $item->category_id=$request->category_id;
        $item->expire_date=$request->expire_date;
        $item->update();
        return redirect()->route('item.index')->with('update','Item is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if($item){
            $item->delete();
        }
        return redirect()->back()->with('delete','Item is deleted successfully');
    }
}
