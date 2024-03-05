<?php

namespace App\Admin\Controllers;

use App\Helpers\FileHelper;
use App\Model\Game;
use App\Http\Controllers\Controller;
use App\Model\Locale;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class GamesController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Game List')
            ->description('All Game')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Game Detail')
            ->description('Details')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('Edit Game')
            ->body($this->form($id)->edit($id))
            ->row($this->addRulesGameMode($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('Create Game')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Game());

        $grid->id('ID')->sortable();
        $grid->name('Name')->editable();
        $grid->created_at('Created At');
        $grid->updated_at('Updated At');

        $grid->paginate(20);
        $grid->disableExport();
        $grid->disableColumnSelector();

        $grid->filter(function($filter){

            // Remove the default id filter
            $filter->disableIdFilter();

            // Add a column filter
            $filter->like('name', 'Name');



        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Game::findOrFail($id));


        $show->id('ID');
        $show->name('Name');
        $show->image('İmage');
        $show->cover('Cover');
        $show->created_at('Created at');
        $show->updated_at('Updated at');


        return $show;
    }

    private function addRulesGameMode($gameId) {
        $gameModes= Game::find($gameId)->gameModes()->with('rules.locale')->get()->toArray();
        $locale = Locale::all()->toArray();

        $data = [
            'locales' => $locale,
            'gameModes' => $gameModes,
        ];

        return view('admin/form.app', ['components' => ['game-rules'], 'data' => $data]);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Game());

        $form->text('name','Name')->required();

        $form->text('tag','Tag');

        $imageFilename = '';
        if ($newFile = request()->image) {
            $imageFilename = FileHelper::formatFileName($newFile, true);
        }

        $form->image('image',  __('Image'))->move('games',"$imageFilename")->required();

        $coverFilename = '';
        if ($newFile = request()->cover) {
            $coverFilename = FileHelper::formatFileName($newFile, true);
        }

        $form->image('cover',  __('Cover'))->move('games',"$coverFilename")->required();
        $form->html("
            <style>
              .kv-file-content{
                background-color: #dbdbdb;
              }
            </style>
        ");

       /* if ($gameId) {
          //  dd(Game::find($gameId)->gameModes()->get()->toArray());
            $form->hasMany('gameModes', '', function (Form\NestedForm $nestedForm) {
                $nestedForm->text('name');
            });
        }*/

        $form->saving(function (Form $form) {
            if(empty($form->tag)) {
                $form->tag = Str::snake($form->name);
            }

        });

        return $form;
    }
}
