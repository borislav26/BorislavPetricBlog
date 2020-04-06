<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderItem;
use Intervention\Image\Image;

class SliderItemsController extends Controller {

    public function index() {
        $sliderItems = SliderItem::all();
        return view('admin.slider_items.index', [
            'sliderItems' => $sliderItems
        ]);
    }

    public function add() {
        return view('admin.slider_items.add');
    }

    public function insert(Request $request) {
        $formData = $request->validate([
            'title' => ['required', 'string', 'max:30'],
            'button_name' => ['required', 'string', 'max:20'],
            'url' => ['required', 'string'],
            'image' => ['required', 'file', 'image', 'max:51200'],
        ]);

        $sliderItem = new SliderItem();

        $sliderItem->fill($formData);

        $lastInRow = SliderItem::query()
                ->orderBy('order', 'desc')
                ->first();
        $sliderItem->order = $lastInRow->order + 1;
        $sliderItem->save();


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $sliderItem->id . '_' . $file->getClientOriginalName();

            $file->move(public_path('/storage/slider_items/', $fileName));

            $sliderItem->image = $fileName;

            $sliderItem->save();

            \Image::make(public_path('/storage/slider_items/', $sliderItem->image))
                    ->fit(200, 200)
                    ->save();
        }


        return redirect()->route('admin.slider_items.index');
    }

    public function changeOrder(Request $request) {
        $formData = $request->validate([
            'orders' => ['required', 'string']
        ]);
        $orders = explode(',', $formData['orders']);
        foreach ($orders as $key => $order) {
            $sliderItem = SliderItem::findOrFail($order);
            $sliderItem->order = $key + 1;
            $sliderItem->save();
        }

        return redirect()->back();
    }

    public function edit(SliderItem $sliderItem) {

        return view('admin.slider_items.edit', [
            'sliderItem' => $sliderItem
        ]);
    }

    public function update(Request $request, SliderItem $sliderItem) {
        $formData = $request->validate([
            'title' => ['required', 'string', 'max:30'],
            'button_name' => ['required', 'string', 'max:20'],
            'url' => ['required', 'string'],
            'image' => ['required', 'file', 'image', 'max:51200'],
        ]);



        $sliderItem->fill($formData);



        $sliderItem->save();


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $sliderItem->id . '_' . $file->getClientOriginalName();

            $file->move(public_path('/storage/slider_items/', $fileName));

            $sliderItem->image = $fileName;

            $sliderItem->save();

            \Image::make(public_path('/storage/slider_items/', $sliderItem->image))
                    ->fit(200, 200)
                    ->save();
        }


        return redirect()->route('admin.slider_items.index');
    }

    public function delete(Request $request) {
        $formData = $request->validate([
            'slider_id' => ['required', 'numeric', 'exists:slider_items,id']
        ]);

        $item = SliderItem::findOrFail($formData['slider_id']);

        
        $item->delete();

        return redirect()->route('admin.slider_items.index');
    }

}
