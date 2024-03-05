<?php

namespace App\Admin\Controllers;

use App\Model\Evidence;
use App\Model\File;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class EvidenceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Evidence';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Evidence());

        $grid->column('id', __('Id'));
        $grid->column('match_team_id', __('Match team id'));
        $grid->column('created_at', __('Created at'));

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
        $show = new Show(Evidence::findOrFail($id));
        $show->field('match_team_id', __('Match team id'));

        return $show;
    }

    /**
     * Show interface.
     *
     * @param  mixed  $id
     * @param  Content  $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Evidence Details')
            ->description('Details')
            ->body($this->detail($id))
            ->row($this->getEvidenceFilesContent($id));
    }

    /**
     * Edit interface.
     *
     * @param  mixed  $id
     * @param  Content  $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('Edit Evidence')
            ->body($this->form()->edit($id))
            ->row($this->getEvidenceFilesContent($id));
    }

    private function getEvidenceFilesContent($id){

        $evidence = Evidence::find($id);

        $data = [
            'evidence' => $evidence,
            'files' => $evidence->files
        ];

        return view('admin/form.app', ['components' => ['evidence-files'], 'data' => $data]);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Evidence());

        $form->text('match_team_id', __('Match team id'))->disable();

        return $form;
    }
}
