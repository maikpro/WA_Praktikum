<?php
class KalenderController
{
    private $date;

    public function __construct()
    {
        $this->date = getdate();
    }

    /**
     * returns current day as number
     */
    public function get_current_day()
    {
        return $this->date['mday'];
    }

    /**
     * return current month as number
     */
    public function get_current_month()
    {
        return $this->date['mon'];
    }

    /**
     * return current month as string january
     */
    public function get_current_month_string()
    {
        return $this->date['month'];
    }

    /**
     * returns current year as number yyyy
     */
    public function get_current_year()
    {
        return $this->date['year'];
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

    public function printCalender()
    {
        $startDay = 0;
        $lastDay = $this->get_last_day_of_month($this->get_current_month(), $this->get_current_year());
        $html = '<tr>';
        $html .= '<th scope="row">01</th>';
        for ($d = 1; $d <= $lastDay; $d++) {
            $html .= "<td>" . $d . "</td>";
            $startDay++;

            if ($startDay > 6 && $d < $lastDay) {
                $startDay = 0;
                $html .= "</tr>";
                $html .= "<tr>";
                $html .= '<th scope="row">01</th>';
            }
        }

        return $html;
    }
}
