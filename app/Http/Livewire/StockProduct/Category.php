<?php

namespace App\Http\Livewire\StockProduct;

use App\Models\CategoryModal;
use App\Models\CategoryProduct;
use App\Models\newCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $cat_name, $cat_status;
    public $modal_cat_name, $modal_cat_status, $modal_cat_id;
    public $search = '';
    public $show_button = true;
    public $readonly = '';
    public $disabled = '';

    public function render()
    {
       //  return view('livewire.stock-product.category');

        return view('livewire.stock-product.category', [
            'categories' => \App\Models\Category::where('category_name', 'like', '%' . $this->search . '%')
                ->orderBy('id', 'DESC')
                ->paginate(5),
        ]);

    }

    public function resetInput()
    {
        $this->cat_name = '';
        $this->cat_status = '';

        $this->show_button = true;
        $this->readonly = '';
        $this->disabled = '';

        $this->modal_cat_status = '';
        $this->modal_cat_name = '';

        $this->dispatchBrowserEvent('close_modal');
        $this->resetValidation();
        $this->resetPage();
    }

    public function SimpanCategory()
    {
        \App\Models\Category:: create([
            'category_name' => $this->cat_name,
            'category_status' => $this->cat_status,
        ]);

        $this->dispatchBrowserEvent('swal:modal_category', [
            'type' => 'success',
            'message' => 'Data Successfully Created!',
        ]);

        $this->emit('refresh_table_summary');
        $this->resetInput();
    }

    public function view_category($category_id)
    {
        $get_category = \App\Models\Category::where('id', $category_id)->first();
        $this->cat_status = $get_category->category_status;
        $this->cat_name = $get_category->category_name;

        $this->show_button = false;
        $this->readonly = 'readonly';
        $this->disabled = 'disabled';
    }

    public function edit_category($category_id)
    {
        $get_details = \App\Models\Category::where('id', $category_id)->first();

        $this->modal_cat_id = $get_details->id;
        $this->modal_cat_name = $get_details->category_name;
        $this->modal_cat_status = $get_details->category_status;

        $this->dispatchBrowserEvent('open_modal');
    }

    public function delete_category($category_id)
    {
        $this->dispatchBrowserEvent('swal.category', [
            'type' => 'warning',
            'title' => 'Are you sure you want to continue?',
            'text' => '',
            'id' => $category_id,
            'function' => 'delete',
        ]);
    }

    public function delete($id)
    {
        CategoryProduct::where('category_id', $id)->delete();

        $category_delete = \App\Models\Category::findOrFail($id);

        if ($category_delete) {

            \App\Models\Category::where('id', $id)->delete();
        }

        $this->emit('refresh_table_summary');
        $this->resetInput();
        $this->dispatchBrowserEvent('swal:modal_category', [
            'type' => 'success',
            'message' => 'Data Successfully Deleted!',
        ]);

    }

    public function update_category()
    {
        $this->validate([
            'modal_cat_name' => 'required',
            'modal_cat_status' => 'required',
        ], [
            'modal_cat_name.required' => 'Nama Kategori wajib di isi!',
            'modal_cat_status.required' => 'Status Kategori wajib di isi!',
        ]);

        $this->dispatchBrowserEvent('swal.category', [
            'type' => 'warning',
            'title' => 'Are you sure you want to continue?',
            'text' => '',
            'id' => $this->modal_cat_id,
            'function' => 'update_confirm',
        ]);
    }

    public function update_confirm($id)
    {
        $check = \App\Models\Category::findOrFail($id);
        if ($check) {
            $check->update([
                'category_name' => $this->modal_cat_name,
                'category_status' => $this->modal_cat_status,
            ]);

            $this->emit('refresh_table_summary');
            $this->dispatchBrowserEvent('swal:modal_category', [
                'type' => 'success',
                'message' => 'Data Successfully Updated!',
            ]);
        } else {

            $this->dispatchBrowserEvent('swal:modal_category', [
                'type' => 'error',
                'message' => 'Error!',
            ]);

        }

        $this->resetInput();

    }

    public function confirmSimpan()
    {
        $this->validate([
            'cat_name' => 'required',
            'cat_status' => 'required',
        ], [
            'cat_name.required' => 'Nama Kategori wajib di isi!',
            'cat_status.required' => 'Status Kategori wajib di isi!',
        ]);

//        $this->dispatchBrowserEvent('test');

        $this->dispatchBrowserEvent('swal.category', [
            'type' => 'warning',
            'title' => 'Are you sure you want to continue?',
            'text' => '',
            'function' => 'SimpanCategory',
        ]);
    }

    public function alertCancel()
    {
        $this->dispatchBrowserEvent('swal:modal_category', [
            'type' => 'success',
            'message' => 'Operation Cancelled!',
        ]);
    }

}
