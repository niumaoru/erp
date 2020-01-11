<?php

namespace App\Admin\Controllers;

use App\Models\Brand;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use function foo\func;
use Illuminate\Support\Facades\Route;
use Encore\Admin\Widgets\Table;

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
        $grid->column('brand_name', __('Brand name'))->label()
            ->expand(function (){
                $products = $this->products()->get()->map(function ($product){
                    return $product->only(['product_number', 'product_name']);
                });

                return new Table(['货品编码', '货品名称'], $products->toArray());
            });
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

        $grid->enableHotKeys();

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

        $form->number('sort', __('Sort'))->min(1);
        $form->text('brand_number', __('Brand number'))
            ->creationRules(['required', 'max:30' ,'unique:brands'])
            ->updateRules(['required', 'max:30']);
        $form->text('brand_name', __('Brand name'))->rules('required"|max:40');
        $form->switch('enable', __('Enable'))->default(true);

        $form->footer(function ($footer){
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });



        return $form;
    }
}
