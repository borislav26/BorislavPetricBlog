<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderItem;
use Intervention\Image\Image;

class SliderItemsController extends Controller {

    public function index() {
        if (\Auth::user()->role_id == 3) {
            return redirect()->route('admin.index.index');
        }
        $sliderItems = SliderItem::all();
        return view('admin.slider_items.index', [
            'sliderItems' => $sliderItems
        ]);
    }

    public function add() {
        if (\Auth::user()->role_id == 3) {
            return redirect()->route('admin.index.index');
        }
        return view('admin.slider_items.add');
    }

    public function insert(Request $request) {
        if (\Auth::user()->role_id == 3) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'title' => ['required', 'string', 'max:30'],
            'button_name' => ['required', 'string', 'max:20'],
            'url' => ['required', 'string'],
            'image' => ['nullable', 'file', 'image', 'max:51200'],
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

            $file->move(public_path('/storage/slider_items/'), $fileName);

            $sliderItem->image = $fileName;

            $sliderItem->save();

            \Image::make(public_path('/storage/slider_items/' . $sliderItem->image))
                    ->save();
        }
        session()->flash(
                'session_message', 'You have added new slider item successfully!'
        );

        return redirect()->route('admin.slider_items.index');
    }

    public function changeOrder(Request $request) {
        if (\Auth::user()->role_id == 3) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'orders' => ['required', 'string']
        ]);
        $orders = explode(',', $formData['orders']);
        foreach ($orders as $key => $order) {
            $sliderItem = SliderItem::findOrFail($order);
            $sliderItem->order = $key + 1;
            $sliderItem->save();
        }
        session()->flash([
            'session_message' => 'You have change order successfully!'
        ]);
        return redirect()->back();
    }

    public function edit(SliderItem $sliderItem) {
        if (\Auth::user()->role_id == 3) {
            return redirect()->route('admin.index.index');
        }
        return view('admin.slider_items.edit', [
            'sliderItem' => $sliderItem
        ]);
    }

    public function update(Request $request, SliderItem $sliderItem) {
        if (\Auth::user()->role_id == 3) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'title' => ['required', 'string', 'max:30'],
            'button_name' => ['required', 'string', 'max:20'],
            'url' => ['required', 'string'],
            'image' => ['nullable', 'file', 'image', 'max:51200'],
        ]);



        $sliderItem->fill($formData);



        $sliderItem->save();


        if ($request->hasFile('image')) {
            $sliderItem->deletePhoto();
            $file = $request->file('image');
            $fileName = $sliderItem->id . '_' . $file->getClientOriginalName();

            $file->move(public_path('/storage/slider_items/'), $fileName);

            $sliderItem->image = $fileName;

            $sliderItem->save();

            \Image::make(public_path('/storage/slider_items/' . $sliderItem->image))
                    ->save();
        }
        session()->flash(
                'session_message', 'You have updated slider item successfully!'
        );

        return redirect()->route('admin.slider_items.index');
    }

    public function delete(Request $request) {
        if (\Auth::user()->role_id == 3) {
            return redirect()->route('admin.index.index');
        }
        $formData = $request->validate([
            'slider_id' => ['required', 'numeric', 'exists:slider_items,id']
        ]);

        $item = SliderItem::findOrFail($formData['slider_id']);

        $item->deletePhoto();
        $item->delete();

        return response()->json([
                    'success_message' => 'You have deleted slider item successfully!'
        ]);
    }

    public function tableContent() {
        if (\Auth::user()->role_id != 1) {
            return redirect()->route('admin.index.index');
        }
        $sliderItems = SliderItem::all();
        return view('admin.slider_items.partials.table_content', [
            'sliderItems' => $sliderItems
        ]);
    }

}
