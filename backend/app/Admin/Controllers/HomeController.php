<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\BoxMatches;
use App\Model\Match;
use App\Model\Team;
use App\Model\Tournament;
use App\Model\User;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Dashboard')
            ->description('Banger Games dashboard')
            ->row(function (Row $row) {

                $row->column(6, function (Column $column) {
                    $column->append((new InfoBox('Tournaments', 'sitemap', 'blue', '/admin/tournament', Tournament::all()->count()))->render());
                });
                $row->column(6, function (Column $column) {
                    $column->append((new InfoBox('Matches', 'tasks', 'green', '/admin/matches', Match::all()->count()))->render());
                });
                $row->column(12, function (Column $column) {
                    $column->append((new InfoBox('Box match', 'trophy', 'red', '/admin/box-matches-all', BoxMatches::all()->count()))->render());
                });

                $row->column(6, function (Column $column) {
                    $column->append((new InfoBox('Users', 'user', 'aqua', '/admin/user', User::all()->count()))->render());
                });
                $row->column(6, function (Column $column) {
                    $column->append((new InfoBox('Teams', 'users', 'yellow', '/admin/teams', Team::all()->count()))->render());
                });
            });
    }
}
