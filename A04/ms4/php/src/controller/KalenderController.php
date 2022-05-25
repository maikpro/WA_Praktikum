<?php
class KalenderController
{
    private $selected_month;
    private $selected_year;

    private $prev_month;
    private $current_date;
    private $next_month;

    private $prev_year;
    private $next_year;

    public function __construct()
    {
        $this->current_date = getdate();
        $this->selected_month = $this->get_current_month();
        $this->selected_year = $this->get_current_year();
        $this->set_prev_month($this->get_current_month() - 1);
        $this->set_next_month($this->get_current_month() + 1);

        $this->set_prev_year($this->get_current_year() - 1);
        $this->set_next_year($this->get_current_year() + 1);

        //updates
        $this->update_to_prev_month();
        $this->update_to_next_month();

        $this->update_to_prev_year();
        $this->update_to_next_year();
    }

    public function set_selected_month($selected_month)
    {
        $this->selected_month = $selected_month;
    }

    public function get_selected_month()
    {
        return $this->selected_month;
    }

    /**
     * return current month as string january
     */
    public function get_selected_month_string()
    {
        // hier nochmal mit selected year updaten!!!
        $timestamp = mktime(0, 0, 0, $this->selected_month, 1, $this->get_current_year());
        //return date('F', mktime(0, 0, 0, $this->selected_month, 1, $this->get_current_year()));

        return strftime('%B', $timestamp);
    }

    public function set_selected_year($selected_year)
    {
        $this->selected_year = $selected_year;
    }

    public function get_selected_year()
    {
        return $this->selected_year;
    }

    public function set_prev_month($prev_month)
    {
        $this->prev_month = getdate(mktime(0, 0, 0, $prev_month, 1, $this->get_selected_year()));
    }

    public function get_prev_month()
    {
        return $this->prev_month['mon'];
    }

    public function update_to_prev_month()
    {
        if (isset($_GET["prev"]) && isset($_GET["month"]) && isset($_GET["year"])) {
            $month = $_GET["month"];
            $year = $_GET["year"];

            $this->set_selected_year($year);
            $this->set_prev_year($this->selected_year - 1);

            // update selected month
            $this->set_selected_month($month);

            // set new prev month!
            $this->set_prev_month($month - 1);

            // set new next month
            $this->set_next_month($month + 1);
        }
    }

    public function update_to_prev_year()
    {
        if (isset($_GET["prev_year"]) && isset($_GET["month"]) && isset($_GET["year"])) {
            $month = $_GET["month"];
            $year = $_GET["year"];

            $this->set_selected_year($year);
            $this->set_next_year($this->selected_year + 1);
            $this->set_prev_year($this->selected_year - 1);

            // update selected month
            $this->set_selected_month($month);

            // set new prev month!
            $this->set_prev_month($month - 1);

            // set new next month
            $this->set_next_month($month + 1);
        }
    }

    public function set_next_month($next_month)
    {
        $this->next_month = getdate(mktime(0, 0, 0, $next_month, 1, $this->get_selected_year()));
    }

    public function get_next_month()
    {
        return $this->next_month['mon'];
    }

    public function set_next_year($next_year)
    {
        $this->next_year = getdate(mktime(0, 0, 0, $this->get_next_month(), 1, $next_year));
    }

    public function get_next_month_year()
    {
        if ($this->get_next_month() == 1) {
            return $this->next_year['year'];
        }
        return $this->selected_year;
    }

    public function set_prev_year($prev_year)
    {
        $this->prev_year = getdate(mktime(0, 0, 0, $this->get_next_month(), 1, $prev_year));
    }

    public function get_prev_month_year()
    {
        if ($this->get_prev_month() == 12) {
            return $this->prev_year['year'];
        }
        return $this->selected_year;
    }

    public function get_prev_year()
    {
        return $this->prev_year['year'];
    }

    public function get_next_year()
    {
        return $this->next_year['year'];
    }

    public function update_to_next_month()
    {
        if (isset($_GET["next"]) && isset($_GET["month"]) && isset($_GET["year"])) {
            $month = $_GET["month"];
            $year = $_GET["year"];

            $this->set_selected_year($year);
            $this->set_next_year($this->selected_year + 1);

            // update selected month
            $this->set_selected_month($month);

            // set new prev month!
            $this->set_prev_month($month - 1);

            // set new next month!
            $this->set_next_month($month + 1);
        }
    }

    public function update_to_next_year()
    {
        if (isset($_GET["next_year"]) && isset($_GET["month"]) && isset($_GET["year"])) {
            $month = $_GET["month"];
            $year = $_GET["year"];

            $this->set_selected_year($year);
            $this->set_next_year($this->selected_year + 1);
            $this->set_prev_year($this->selected_year - 1);

            // update selected month
            $this->set_selected_month($month);

            // set new prev month!
            $this->set_prev_month($month - 1);

            // set new next month!
            $this->set_next_month($month + 1);
        }
    }


    /**
     * returns current day as number
     */
    public function get_current_day()
    {
        return $this->current_date['mday'];
    }

    /**
     * return current month as number
     */
    public function get_current_month()
    {
        return $this->current_date['mon'];
    }



    /**
     * returns current year as number yyyy
     */
    public function get_current_year()
    {
        return $this->current_date['year'];
    }

    private function get_last_day_of_month($mon, $year)
    {
        if (checkdate($mon, 31, $year))
            $lastDay = 31;
        elseif (checkdate($mon, 30, $year))
            $lastDay = 30;
        elseif (checkdate($mon, 29, $year))
            $lastDay = 29;
        elseif (checkdate($mon, 28, $year))
            $lastDay = 28;

        return $lastDay;
    }

    /**
     * gibt den ersten Tag des Monats als Timestamp zurück.
     */
    private function get_first_day_of_month_as_timestamp($month, $year)
    {
        return mktime(0, 0, 0, $month, 1, $year);
    }

    /**
     * gibt die Anzahl an, an welchem Wochentag der Monat beginnt.
     * wird genutzt um die Tage im Kalender aufzufüllen bis zu diesem Tag.
     */
    private function get_first_day_of_month_count($month, $year)
    {
        return date('N', $this->get_first_day_of_month_as_timestamp($month, $year));
    }

    private function get_first_weeknumber_of_month_count($month, $year)
    {
        return date('W', $this->get_first_day_of_month_as_timestamp($month, $year));
    }

    public function printCalender($month, $year)
    {
        $weekNumber = $this->get_first_weeknumber_of_month_count($month, $year);
        $startDay = $this->get_first_day_of_month_count($month, $year) - 1;
        $lastDay = $this->get_last_day_of_month($month, $year);

        $html = '<tr>';

        // erste Woche im Monat!
        $html .= '<th scope="row">' . $weekNumber . '</th>';
        $weekNumber++;

        if ($weekNumber > 52) {
            $weekNumber = 1;
        }

        // füllt leere Tage im Kalender aus bis zum ersten Wochentag des Monats
        $html .= str_repeat("<td></td>", $startDay);

        // End of Week or Month
        for ($d = 1; $d <= $lastDay; $d++) {

            if ($this->get_current_day() == $d && $this->get_current_month() == $month && $this->get_current_year() == $year) {
                // Markiere den heutigen Tag
                $html .= "<td id='today'>" . $d . "</td>";
            } else {
                $html .= "<td>" . $d . "</td>";
            }

            $startDay++;

            if ($startDay > 6 && $d < $lastDay) {
                $startDay = 0;
                $html .= "</tr>";
                $html .= "<tr>";
                $html .= '<th scope="row">' . $weekNumber . '</th>';
                $weekNumber++;
            }
        }

        return $html;
    }
}
