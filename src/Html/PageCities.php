<?php
namespace App\Html;

class PageCities extends AbstractPage
{
    static function table(array $entites)
    {
        echo '<h1>Városok</h1>';
        //self::searchBar();
        echo '<table id="cities-table">';
        self::tableHead();
        self::tableBody($entites);
        echo '</table>';
    }

    static function tableHead()
    {
        echo '<thead>
        <tr>
            <th class="id"-col>#</th>
            <th>Megnevezés</th>
            <th style ="display: flex">Műveletek&nbsp;
                <form method="POST">
                    <button type="submit" id="btn-add-city" name="btn-add-city" title="Új">+</button>
                </form>
            </th>
        </tr>
        <tr id="editor" class="hidden">';
        //self::cityEditor();
        echo '</tr>
        </thead>';
    }

    static function tableBody(array $entites)
    {}
}
