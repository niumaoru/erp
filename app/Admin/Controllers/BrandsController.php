<?php

namespace App\Admin\Controllers;

use App\Models\Brand;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BrandsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '品牌';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Brand());

        $grid->model()->orderBy('sort');
        $grid->column('sort', __('Sort'))->editable();
        $grid->column('brand_number', __('Brand number'));
        $grid->column('brand_name', __('Brand name'));
        $grid->column('enable', __('Enable'))
            ->display(function ($enable){
                return $enable ? '启用' : '暂停';
            });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function ($filter){
            $filter->disableIdFilter();
            $filter->equal('brand_number', __('Brand number'));
            $filter->like('brand_name', __('Brand name'));
        });

        $grid->paginate(10);

        $grid->disableRowSelector();

        $grid->actions(function($actions){
            $actions->disableDelete();
        });

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
        $show = new Show(Brand::findOrFail($id));

        $show->field('brand_number', __('Brand number'));
        $show->field('brand_name', __('Brand name'));
        $show->field('enable', __('Enable'));
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
        $form = new Form(new Brand());

        $form->number('sort', __('Sort'));
        $form->text('brand_number', __('Brand number'));
        $form->text('brand_name', __('Brand name'));
        $form->switch('enable', __('Enable'))->default(1);

        return $form;
    }
}
