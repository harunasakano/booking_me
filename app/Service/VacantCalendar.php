<?php

namespace App\Service;

use Carbon\Carbon;

Class VacantCalendar
{
    /**
     * Vacantのindex画面にユーザーの空き日一覧のカレンダー生成用HTMLを返す
     * TODO 良くないので後で直す
     * @param $date_latest
     * @param $req_year_month
     * @return array
     */
    public function htmlExport($date_latest, $req_year_month)
    {

        $data = [];
        $clean_year_month = [];
        $date_of_first_last = [];
        $req_year_month_key = '';

        foreach ($date_latest as $date_value) {
            $all_year_month[] = date('Y-m', strtotime($date_value));
        }

        if (!empty($all_year_month)) {
            $remove_year_month = array_unique($all_year_month);
            $clean_year_month = array_values($remove_year_month);

            foreach (array_values($clean_year_month) as $year_month_v) {
                $date_of_first_last[$year_month_v]['first'] = date('D', strtotime('first day of ' . $year_month_v));
                $date_of_first_last[$year_month_v]['last'] = date('d', strtotime('last day of ' . $year_month_v));
            }
        }

        //リクエストされた年月からキーを特定　規定値の場合は0(デフォルト)
        if ($req_year_month !== 'default') {
            $req_year_month = str_replace('_', '-', $req_year_month);
            $req_year_month_key = array_search($req_year_month,$clean_year_month);
        } else {
            $req_year_month_key = 0;
        }

        //htmlの生成
        $td_count = 0;
        $html = '';

        for ($i = 1; $i <= $date_of_first_last[$clean_year_month[$req_year_month_key]]['last']; $i++) {
            if ($i == 1) {
                switch ($date_of_first_last[$clean_year_month[$req_year_month_key]]['first']) {
                    case 'Mon':
                        $html =
                            "<tr><td class=" . ++$td_count . ">$i</td>";
                        break;

                    case 'Tue':
                        $html =
                            "<tr><td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . ">$i</td>\n";
                        break;

                    case 'Wed':
                        $html =
                            "<tr><td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . ">$i</td>\n";
                        break;

                    case 'Thu':
                        $html =
                            "<tr><td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . ">$i</td>\n";
                        break;

                    case 'Fri':
                        $html =
                            "<tr><td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . "></td>
                                 <td class=" . ++$td_count . ">$i</td>\n";
                        break;

                    case 'Sat':
                        $html =
                            "<tr><td class=\"" . ++$td_count . "\"></td>
                                 <td class=\"" . ++$td_count . "\"></td>
                                 <td class=\"" . ++$td_count . "\"></td>
                                 <td class=\"" . ++$td_count . "\"></td>
                                 <td class=\"" . ++$td_count . "\"></td>
                                 <td class=\"" . ++$td_count . "\">$i</td>\n";
                        break;

                    case 'Sun':
                        "<tr><td class=\"" . ++$td_count . "\"></td>
                                 <td class=\"" . ++$td_count . "\"></td>
                                 <td class=\"" . ++$td_count . "\"></td>
                                 <td class=\"" . ++$td_count . "\"></td>
                                 <td class=\"" . ++$td_count . "\"></td>
                                 <td class=\"" . ++$td_count . "\"></td>
                                 <td class=\"" . ++$td_count . "\">$i</td>\n";
                        break;
                }

            } else {
                if ($i == 2) {
                    $td_count++;

                }
                if ($i !== 1 && $td_count % 7 !== 0) {
                    while ($td_count % 7 !== 0 && $i<= $date_of_first_last[$clean_year_month[$req_year_month_key]]['last']) {
                        $html .= "<td class=\"" . $td_count . "\">$i</td>\n";
                        $td_count++;
                        if ($td_count % 7 !== 0) {
                            $i++;
                        }
                    }
                } else if ($i !== 1 && $td_count % 7 == 0) {
                    $html .= "<td class=\"" . $td_count . "\">$i</td>\n</tr>\n<tr>";
                    ++$td_count;
                }
            }
        }

        //nextリンクとprevリンクの値を決める
        if ($req_year_month_key == 0) {
            $prev_key = 'no_link';
        } else {
            $prev_key = $req_year_month_key-1;
        }

        if ($req_year_month_key == count($clean_year_month)-1) {
            $next_key = 'no_link';
        } else {
            $next_key = $req_year_month_key+1;
        }

        $data['html'] = $html;
        $data['head'] = $clean_year_month[$req_year_month_key];

        $data['prev'] = '';
        $data['next'] = '';

        if ($prev_key !== 'no_link') {
            $data['prev'] = date('Y_m', strtotime($clean_year_month[$prev_key]));
        }

        if ($next_key !== 'no_link') {
            $data['next'] = date('Y_m', strtotime($clean_year_month[$next_key]));
        }

        $data['booking_month'] = $clean_year_month;
        return $data;

    }

}

