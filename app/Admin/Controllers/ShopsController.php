<?php

namespace App\Admin\Controllers;

use App\Models\Platform;
use App\Models\Shop;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ShopsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '店铺';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Shop());

        $grid->model()->orderBy('sort');
        $grid->column('sort', __('Sort'))->editable();
        $grid->column('shop_number', __('Shop number'));
        $grid->column('shop_name', __('Shop name'));
        $grid->column('platform.platform_name', __('Platform id'));
        $grid->column('enable', __('Enable'))
            ->display(function ($enable){
                return $enable ? '启用' : '停用';
            });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function ($filter){
            $filter->disableIdFilter();
            $filter->equal('shop_number', __('Shop number'));
            $filter->like('shop_name', __('Shop name'));
        });

        $grid->paginate(10);

        $grid->disableRowSelector();

        $grid->actions(function ($actions){
            $actions->disableView();
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
        $show = new Show(Shop::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sort', __('Sort'));
        $show->field('shop_number', __('Shop number'));
        $show->field('shop_name', __('Shop name'));
        $show->field('platform_id', __('Platform id'));
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
        $form = new Form(new Shop());

        $form->number('sort', __('Sort'))->min(1);
        $form->text('shop_number', __('Shop number'))
            ->creationRules(['required', 'max:30', 'unique:shops'])
            ->updateRules(['required', 'max:30']);
        $form->text('shop_name', __('Shop name'))
            ->creationRules(['required', 'max:30', 'unique:shops'])
            ->updateRules(['required', 'max:30']);
        $form->select('platform_id', __('Platform id'))->options(Platform::getPlatforms())->rules('required');
        $form->switch('enable', __('Enable'))->default(true);

        $form->footer(function ($footer){
            $footer->disableEditingCheck();
        });

        return $form;
    }
}
