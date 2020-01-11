<?php

namespace App\Admin\Controllers;

use App\Models\Warehouse;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Route;

class WarehousesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '仓库管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Warehouse());

        $grid->model()->orderBy('sort');
        $grid->column('sort', __('Sort'))->editable();
        $grid->column('warehouse_number', __('Warehouse number'));
        $grid->column('warehouse_name', __('Warehouse name'));
        $grid->column('address', __('Address'))
            ->display(function (){
                return $this->province . $this->city . $this->district . $this->address;
            });
        $grid->column('contact_name', __('Contact name'));
        $grid->column('contact_phone', __('Contact phone'));
        $grid->column('warehouse_type', __('Warehouse type'))
            ->using(['保税仓', '普通仓', '海外仓' ,'其它仓']);
        $grid->column('defect_warehouse', __('Defect warehouse'))
            ->display(function ($defect_warehouse){
                return $defect_warehouse ? '残次仓' : '正品仓';
            });
        $grid->column('enable',__('启用状态'))
            ->display(function ($enble){
                return $enble ? '启用' : '停用';
            });

        // filter($callback)方法用来设置表格的简单搜索框
        $grid->filter(function ($filter){
            //去掉默认ID过滤器
            $filter->disableIdFilter();
            $filter->equal('warehouse_number', __('Warehouse_number'))->placeholder('请输入仓库编码');
            $filter->like('warehouse_name', __('Warehouse_name'))->placeholder('请输入仓库名称');
        });

        //每页显示10条
        $grid->paginate(10);

        //禁用行选择器
        $grid->disableRowSelector();

        //禁用行操作
        //$grid->disableActions();
        $grid->actions(function ($actions){
            //$actions->disableView();
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
    $show = new Show(Warehouse::findOrFail($id));

    $show->field('id', __('Id'));
    $show->field('sort', __('Sort'));
    //$show->field('api_type', __('Api type'));
    $show->field('warehouse_number', __('Warehouse number'));
    $show->field('warehouse_name', __('Warehouse name'));
    $show->field('province', __('Province'));
    $show->field('city', __('City'));
    $show->field('district', __('District'));
    $show->field('address', __('Address'));
    $show->field('contact_name', __('Contact name'));
    $show->field('contact_phone', __('Contact phone'));
    $show->field('warehouse_type', __('Warehouse type'))
        ->using(['0' => '保税仓', '1' => '普通仓', '2' => '海外仓' ,'3' => '其它仓']);
    $show->field('defect_warehouse', __('Defect warehouse'))
        ->as(function ($defect_warehous){
            return $defect_warehous ? '残次仓' : '正品仓';
        });
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
        $form = new Form(new Warehouse());

        $form->number('sort',__('Sort'))->min(1);
        $form->text('warehouse_number', __('Warehouse number'))
            ->creationRules('required|max:20|unique:warehouses')
            ->updateRules('required|max:20');
        $form->text('warehouse_name', __('Warehouse name'))->rules('required|max:30');
        $form->text('province', __('Province'))->rules('required');
        $form->text('city', __('City'))->rules('required');
        $form->text('district', __('District'))->rules('required');
        $form->text('address', __('Address'))->rules('required');
        $form->text('contact_name', __('Contact name'))->rules('required|max:30');
        $form->text('contact_phone', __('Contact phone'))->rules('required|size:11');
        $form->radio('warehouse_type', __('Warehouse type'))
            ->options(['保税仓', '普通仓', '海外仓' ,'其它仓'])->default('0');
        $form->radio('defect_warehouse', __('Defect warehouse'))
            ->options(['0' => '正品仓', '1' => '残次仓'])->default('0');
        $form->switch('enable',__('启用状态'))->default(true);

        $form->footer(function ($footer){
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        $status = Route::currentRouteName() == 'warehouses.edit';
        if ($status){
            $form->footer(function ($footer){
                $footer->disableReset();
            });
        }

        return $form;
    }
}
