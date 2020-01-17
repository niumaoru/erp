<?php

namespace App\Admin\Controllers;

use App\Models\Platform;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;

class PlatformsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '电商平台';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Platform());

        $grid->column('platform_number', __('Platform number'));
        $grid->column('platform_name', __('Platform name'))->label()
            ->expand(function ($model){
                $shops = $model->shops()->get()->map(function ($shop){
                    return $shop->only(['shop_number', 'shop_name']);
                });

                return new Table([__('Platform number'), __('Platform name')], $shops->toArray());
            });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->filter(function ($filter){
            $filter->disableIdFilter();
            $filter->equal('platform_number', __('Platform number'));
            $filter->like('platform_name', __('Platform name'));
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
        $show = new Show(Platform::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('platform_number', __('Platform number'));
        $show->field('platform_name', __('Platform name'));
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
        $form = new Form(new Platform());

        $form->text('platform_number', __('Platform number'))
            ->creationRules(['required', 'max:30', 'unique:platforms'])
            ->updateRules(['required', 'max:30']);
        $form->text('platform_name', __('Platform name'))
            ->creationRules(['required', 'max:30', 'unique:platforms'])
            ->updateRules(['required', 'max:30']);

        $form->footer(function ($footer){
            $footer->disableEditingCheck();
        });

        return $form;
    }
}
