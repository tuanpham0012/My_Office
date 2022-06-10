<?php
/**
 * Created by PhpStorm.
 * User: DoanPV
 * Date: 05/02/2020
 * Time: 09:58 AM
 */

function query($conn, $arr, $tbl, $param = '')
{
    $sql = "SELECT $arr FROM $tbl $param";
    $res = mysqli_query($conn, $sql);
    while ($rows = mysqli_fetch_assoc($res)) {
        $result[] = $rows;
    }
    if (isset($result)) {
        return $result;
    } else {
        return null;
    }
}

function queryCount($conn, $arr, $tbl, $param = '')
{
    $sql = "SELECT $arr FROM $tbl $param";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        return mysqli_num_rows($res);
    } else {
        return 0;
    }
}

function queryDelete($conn, $tbl, $id = '')
{
    $sql = "DELETE FROM $tbl WHERE id=" . $id;
    $res = mysqli_query($conn, $sql);
    if ($res) {
        return true;
    } else {
        return false;
    }
}

function formatDate($date, $is_full = true)
{
    if ($date) {
        if ($is_full) {
            return date('d/m/Y H:i:s', strtotime($date));
        }
        return date('d/m/Y', strtotime($date));

    } else {
        return null;
    }

}

function paginate($base_url, $total, $page_index = 1, $page_size = 2)
{
    $link = '';
    $index = 1;
    $btn_next = '>';
    $btn_last = '>|';
    $btn_previous = '<';
    $btn_first = '|<';

    if ($total > 0 && $page_index >= 1 && $page_size >= 1) {
        $pages = ceil($total / $page_size);

        // Previous page
        if ($page_index > 1) {
            $link .= '<a class="pms-page" href="' . $base_url . '&page=1">' . $btn_first . '</a>';
            $link .= '<a class="pms-page" href="' . $base_url . '&page=' . ($page_index - 1) . '">' . $btn_previous . '</a>';
        }

        if ($pages <= 10) {
            for ($index = 1; $index <= $pages; $index++) {
                if ($index == $page_index) {
                    $link .= '<span class="pms-page-current">' . $index . '</span>';
                } else {
                    $link .= '<a class="pms-page" href="' . $base_url . '&page=' . $index . '">' . $index . '</a>';
                }
            }
        } else {
            if ($page_index <= 5) {
                for ($index = 1; $index <= 5; $index++) {
                    if ($index == $page_index) {
                        $link .= '<span class="pms-page-current">' . $index . '</span>';
                    } else {
                        $link .= '<a class="pms-page" href="' . $base_url . '&page=' . $index . '">' . $index . '</a>';
                    }
                }

                $link .= '...';

                $link .= '<a class="pms-page" href="' . $base_url . '&page=' . ($pages - 1) . '">' . ($pages - 1) . '</a>';
                $link .= '<a class="pms-page" href="' . $base_url . '&page=' . $pages . '">' . $pages . '</a>';
            } else if ($page_index > 5 && $page_index < ($pages - 4)) {
                $link .= '<a class="pms-page" href="' . $base_url . '&page=1">1</a>';
                $link .= '<a class="pms-page" href="' . $base_url . '&page=2">2</a>';
                $link .= '...';

                for ($index = ($page_index - 2); $index <= ($page_index + 2); $index++) {
                    if ($index == $page_index) {
                        $link .= '<span class="pms-page-current">' . $index . '</span>';
                    } else {
                        $link .= '<a class="pms-page" href="' . $base_url . '&page=' . $index . '">' . $index . '</a>';
                    }
                }

                $link .= '...';

                $link .= '<a class="pms-page" href="' . $base_url . '&page=' . ($pages - 1) . '">' . ($pages - 1) . '</a>';
                $link .= '<a class="pms-page" href="' . $base_url . '&page=' . $pages . '">' . $pages . '</a>';

            } else {
                $link .= '<a class="pms-page" href="' . $base_url . '&page=1">1</a>';
                $link .= '<a class="pms-page" href="' . $base_url . '&page=2">2</a>';
                $link .= '...';

                for ($index = ($pages - 4); $index <= $pages; $index++) {
                    if ($index == $page_index) {
                        $link .= '<span class="pms-page-current">' . $index . '</span>';
                    } else {
                        $link .= '<a class="pms-page" href="' . $base_url . '&page=' . $index . '">' . $index . '</a>';
                    }
                }
            }
        }

        // Next page
        if ($page_index < $pages) {
            $link .= '<a class="pms-page" href="' . $base_url . '&page=' . ($page_index + 1) . '">' . $btn_next . '</a>';
            $link .= '<a class="pms-page" href="' . $base_url . '&page=' . $pages . '">' . $btn_last . '</a>';
        }

    }

    return $link;
}

function paginateAjax($base_url, $total, $page_index = 1, $page_size = 2, $onclick = 'changePage')
{
    $link = '';
    $index = 1;
    $btn_next = '>';
    $btn_last = '>|';
    $btn_previous = '<';
    $btn_first = '|<';

    if ($total > 0 && $page_index >= 1 && $page_size >= 1) {
        $pages = ceil($total / $page_size);

        // Previous page
        if ($page_index > 1) {
            $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'(1)">' . $btn_first . '</a>';
            $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.($page_index - 1).')">' . $btn_previous . '</a>';
        }

        if ($pages <= 10) {
            for ($index = 1; $index <= $pages; $index++) {
                if ($index == $page_index) {
                    $link .= '<span class="pms-page-current">' . $index . '</span>';
                } else {
                    $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                }
            }
        } else {
            if ($page_index <= 5) {
                for ($index = 1; $index <= 5; $index++) {
                    if ($index == $page_index) {
                        $link .= '<span class="pms-page-current">' . $index . '</span>';
                    } else {
                        $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                    }
                }

                $link .= '...';

                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.($pages - 1).')">' . ($pages - 1) . '</a>';
                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$pages.')">' . $pages . '</a>';

            } else if ($page_index > 5 && $page_index < ($pages - 4)) {
                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'(1)">1</a>';
                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'(2)">2</a>';
                $link .= '...';

                for ($index = ($page_index - 2); $index <= ($page_index + 2); $index++) {
                    if ($index == $page_index) {
                        $link .= '<span class="pms-page-current">' . $index . '</span>';
                    } else {
                        $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                    }
                }

                $link .= '...';

                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.($pages - 1).')">' . ($pages - 1) . '</a>';
                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$pages.')">' . $pages . '</a>';

            } else {
                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'(1)">1</a>';
                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'(2)">2</a>';
                $link .= '...';

                for ($index = ($pages - 4); $index <= $pages; $index++) {
                    if ($index == $page_index) {
                        $link .= '<span class="pms-page-current">' . $index . '</span>';
                    } else {
                        $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                    }
                }
            }
        }

        // Next page
        if ($page_index < $pages) {
            $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.($page_index + 1).')">' . $btn_next . '</a>';
            $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$pages.')">' . $btn_last . '</a>';
        }

    }

    return $link;
}

function responseApi($code, $message, $data)
{
    echo json_encode([
        'code' => intval($code),
        'message' => $message,
        'data' => $data
    ]);
    die();
}

function callCurl($postFields, $url, $method='POST')
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_PORT => "80",
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => $postFields,
        CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Content-Type: application/json"
        )
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        die(json_encode($err));
        return null;
    } else {
        return $response;
    }
}
