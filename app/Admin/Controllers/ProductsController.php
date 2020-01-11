<?php

namespace App\Admin\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Product';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('product_number', __('Product number'));
        $grid->column('product_name', __('Product name'));
        $grid->column('short_name', __('Short name'));
        $grid->column('brand.brand_name', __('Brand name'));
        $grid->column('category', __('Category'));
        $grid->column('specification', __('Specification'));
        $grid->column('country', __('Country'));
        $grid->column('unit', __('Unit'));
        $grid->column('weight', __('Weight'));
        $grid->column('volume', __('Volume'));
        $grid->column('record_code', __('Record code'));
        $grid->column('barcode', __('Barcode'));
        $grid->column('hs_code', __('Hs code'));
        $grid->column('note', __('Note'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('product_number', __('Product number'));
        $show->field('product_name', __('Product name'));
        $show->field('short_name', __('Short name'));
        $show->field('category', __('Category'));
        $show->field('brand_id', __('Brand id'));
        $show->field('specification', __('Specification'));
        $show->field('country', __('Country'));
        $show->field('unit', __('Unit'));
        $show->field('weight', __('Weight'));
        $show->field('volume', __('Volume'));
        $show->field('record_code', __('Record code'));
        $show->field('barcode', __('Barcode'));
        $show->field('hs_code', __('Hs code'));
        $show->field('note', __('Note'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product());

        $form->text('product_number', __('Product number'));
        $form->text('product_name', __('Product name'));
        $form->text('short_name', __('Short name'));
        $form->text('category', __('Category'));
        $form->select('brand_id', __('Brand id'))->options(Brand::getBrands());
        $form->text('specification', __('Specification'));
        $form->text('country', __('Country'));
        $form->text('unit', __('Unit'));
        $form->decimal('weight', __('Weight'));
        $form->decimal('volume', __('Volume'));
        $form->text('record_code', __('Record code'));
        $form->text('barcode', __('Barcode'));
        $form->text('hs_code', __('Hs code'));
        $form->text('note', __('Note'));

        return $form;
    }
}
