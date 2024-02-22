<?php

use App\Classes\Permissions;
use App\Enums\Actions;
use App\Facades\PermissionManager;
use App\Models\Branch;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Models\OrderDetail;

function get_count_order_detail($id){
    $count = OrderDetail::where('order_id', $id)->count();
    return $count;
}


if (!function_exists('carbon')) {
    function carbon($time = null, $tz = null)
    {
        return new Carbon($time, $tz);
    }
}

if (!function_exists('get_thai_date_format')) {
    function get_thai_date_format($date = null, $format = 'j M Y H:i')
    {
        $carbon = carbon($date);

        $format = str_replace('M', get_short_thai_month($carbon->month), $format);
        $format = str_replace('F', get_thai_month($carbon->month), $format);
        $format = str_replace('Y', $carbon->year + 543, $format);

        return $carbon->format($format);
    }
}

if (!function_exists('custom_date_format')) {
    function custom_date_format($date = null, $with_time = false, $format = null)
    {
        if (empty($date)) {
            return null;
        }
        $default_format = $with_time ? 'd/m/Y h:i' : 'd/m/Y';
        if (!empty($format)) {
            $default_format = $format;
        }
        return date($default_format, strtotime($date));
    }
}

if (!function_exists('get_date_time_by_format')) {
    function get_date_time_by_format($date = null, $format = 'd/m/Y')
    {
        $default_format = 'Y-m-d H:i:s';
        $date = DateTime::createFromFormat($default_format, $date);
        return $date->format($format);
    }
}

if (!function_exists('get_date_by_format')) {
    function get_date_by_format($date = null, $format = 'd/m/Y')
    {
        $default_format = 'Y-m-d';
        $date = DateTime::createFromFormat($default_format, $date);

        if ($date !== false) {
            return $date->format($format);
        }

        return null;
    }
}

if (!function_exists('get_short_thai_month')) {
    function get_short_thai_month($number)
    {
        $months = [
            'ม.ค.',
            'ก.พ.',
            'มี.ค.',
            'เม.ย.',
            'พ.ค.',
            'มิ.ย.',
            'ก.ค.',
            'ส.ค.',
            'ก.ย.',
            'ต.ค.',
            'พ.ย.',
            'ธ.ค.'
        ];

        return $months[$number - 1];
    }
}

if (!function_exists('get_thai_month')) {
    function get_thai_month($number)
    {
        $months = [
            'มกราคม',
            'กุมภาพันธ์',
            'มีนาคม',
            'เมษายน',
            'พฤษภาคม',
            'มิถุนายน',
            'กรกฎาคม',
            'สิงหาคม',
            'กันยายน',
            'ตุลาคม',
            'พฤศจิกายน',
            'ธันวาคม'
        ];

        return $months[$number - 1];
    }
}

if (!function_exists('get_radio_value_yes_no')) {
    function get_radio_value_yes_no()
    {
        return [
            [
                'id' => '1',
                'value' => '1',
                'name' => __('lang.yes')
            ],
            [
                'id' => '0',
                'value' => '0',
                'name' => __('lang.no')
            ],
        ];
    }
}

if (!function_exists('get_medias_detail')) {
    function get_medias_detail($medias)
    {
        return $medias->map(function ($media) {
            $file_path_storage = str_replace(config('app.url'), '', $media->getUrl());
            $file_path_storage = str_replace('/storage/', '', $file_path_storage);
            return [
                'media_id' => $media->id,
                'url' => $media->getUrl(),
                //'url_thumb' => $media->getUrl('thumb'),
                'url_thumb' => $media->getUrl(),
                'file_name' => $media->file_name,
                'name' => $media->name,
                'size' => $media->size,
                'readable_size' => $media->human_readable_size,
                'mime_type' => $media->mime_type,
                'file_path' => $media->getPath(),
                'file_path_storage' => $file_path_storage,
                'created_at' => $media->created_at,
            ];
        })->toArray();
    }
}

if (!function_exists('badge_render')) {
    function badge_render($badge_class = null, $text = null, $class = null)
    {
        return view('admin.components.badges.badge-default', [
            'badge_class' => $badge_class,
            'text' => $text,
            'class' => $class,
        ])->render();
    }
}

if (!function_exists('badge_status_render')) {
    function badge_status_render($status)
    {
        $status = intval($status);
        return view('admin.components.badges.badge-default', [
            'badge_class' => __('lang.status_class_' . $status),
            'text' => __('lang.status_' . $status),
            'class' => null,
        ])->render();
    }
}

if (!function_exists('findObjectById')) {
    function findObjectById($array, $id)
    {
        foreach ($array as $element) {
            if ($id == $element->id) {
                return $element;
            }
        }
        return false;
    }
}

if (!function_exists('get_user_name')) {
    function get_user_name()
    {
        return Session::get('user.name');
    }
}

if (!function_exists('get_department_name')) {
    function get_department_name()
    {
        return Session::get('user.department_name');
    }
}

if (!function_exists('get_branch_name')) {
    function get_branch_name()
    {
        return Session::get('user.branch_name');
    }
}

if (!function_exists('get_user_id')) {
    function get_user_id()
    {
        return Auth::user()->id;
    }
}

if (!function_exists('get_branch_id')) {
    function get_branch_id()
    {
        return Auth::user() ? Auth::user()->branch_id : null;
    }
}

if (!function_exists('get_branch_code')) {
    function get_branch_code()
    {
        return Auth::user() ? (Auth::user()->branch ? Auth::user()->branch->code : null) : null;
    }
}

if (!function_exists('get_role_name')) {
    function get_role_name()
    {
        return Session::get('user.role_name');
    }
}

if (!function_exists('transform_float')) {
    function transform_float($string)
    {
        return floatval(str_replace(',', '', $string));
    }
}
if (!function_exists('get_all_permissions')) {
    function get_all_permissions()
    {
        return Permissions::getAllPermissions();
    }
}

if (!function_exists('_p')) {
    function _p($action, $resource)
    {
        return $action . '_' . $resource;
    }
}

if (!function_exists('__p')) {
    function __p($permission)
    {
        return Actions::print($permission);
    }
}

if (!function_exists('user_can')) {
    function user_can($permission)
    {
        return PermissionManager::can($permission);
    }
}

if (!function_exists('get_user_permissions')) {
    function get_user_permissions()
    {
        return PermissionManager::getUserPermissions();
    }
}

if (!function_exists('get_sub_query_car_park_zones')) {
    function get_sub_query_car_park_zones()
    {
        $query = DB::table('car_parks')->select('car_parks.car_id', 'car_parks.car_park_number', 'car_park_zones.code as zone_code')
            ->addSelect('branches.name as branch_name', 'branches.province_id as branch_province_id')
            ->addSelect(DB::raw(' CONCAT(car_park_zones.code, " : ", car_parks.car_park_number) as slot '))
            ->join('car_park_areas', 'car_park_areas.id', '=', 'car_parks.car_park_area_id')
            ->join('car_park_zones', 'car_park_zones.id', '=', 'car_park_areas.car_park_zone_id')
            ->join('branches', 'branches.id', '=', 'car_park_zones.branch_id')
            ->whereNotNull('car_parks.car_id')
            ->where('car_park_zones.branch_id', get_branch_id());
        return $query;
    }
}

if (!function_exists('get_car_park_detail')) {
    function get_car_park_detail($car_id)
    {
        $car_park = DB::table('car_parks')->select('car_parks.car_id', 'car_parks.car_park_number', 'car_park_zones.code as zone_code')
            ->addSelect(DB::raw(' CONCAT(car_park_zones.code, " : ", car_parks.car_park_number) as slot '))
            ->addSelect('branches.name as branch_name')
            ->leftJoin('car_park_areas', 'car_park_areas.id', '=', 'car_parks.car_park_area_id')
            ->leftJoin('car_park_zones', 'car_park_zones.id', '=', 'car_park_areas.car_park_zone_id')
            ->leftJoin('branches', 'branches.id', '=', 'car_park_zones.branch_id')
            ->where('car_parks.car_id', $car_id)
            ->first();
        return $car_park;
    }
}

if (!function_exists('get_car_detail')) {
    function get_car_detail($car_id)
    {
        $car = Car::select('cars.*', 'car_colors.name as car_color_name', 'car_classes.name as car_class_name', 'car_classes.full_name as class_name')
            ->addSelect('car_types.name as car_type_name', 'car_types.car_brand_id', 'car_brands.name as car_brand_name')
            ->addSelect('car_park_zones.zone_code', 'car_park_zones.car_park_number', 'car_park_zones.slot', 'car_park_zones.branch_name')
            ->leftjoin('car_colors', 'car_colors.id', '=', 'cars.car_color_id')
            ->leftjoin('car_classes', 'car_classes.id', '=', 'cars.car_class_id')
            ->leftjoin('car_types', 'car_types.id', '=', 'car_classes.car_type_id')
            ->leftjoin('car_brands', 'car_brands.id', '=', 'car_types.car_brand_id')
            ->leftJoinSub(get_sub_query_car_park_zones(), 'car_park_zones', function ($join) {
                $join->on('cars.id', '=', 'car_park_zones.car_id');
            })
            ->where('cars.id', $car_id)
            ->where('cars.branch_id', get_branch_id())
            ->first();
        if ($car) {
            $car->rental_type_name = __('cars.rental_type_' . $car->rental_type);
            $car->display_name = null;
            if ($car->license_plate) {
                $car->display_name = $car->license_plate;
            } else if ($car->engine_no) {
                $car->display_name = __('inspection_cars.engine_no') . ' ' . $car->engine_no;
            } else if ($car->chassis_no) {
                $car->display_name = __('inspection_cars.chassis_no') . ' ' . $car->chassis_no;
            }
            $car->display_full_name = implode(' / ', array_filter([$car->license_plate, $car->engine_no, $car->chassis_no]));
        }
        return $car;
    }
}

if (!function_exists('get_car_detail2')) {
    function get_car_detail2($car_id)
    {
        $car = Car::select('cars.id', 'cars.code', 'cars.license_plate', 'cars.engine_no', 'cars.chassis_no', 'cars.rental_type')
            ->addSelect('car_colors.name as car_color_name', 'car_classes.name as car_class_name', 'car_classes.full_name as class_name', 'car_park_zones.branch_name')
            ->addSelect('car_types.name as car_type_name', 'car_types.car_brand_id', 'car_brands.name as car_brand_name')
            ->addSelect('car_park_zones.zone_code as car_park_zone_name', 'car_park_zones.car_park_number', 'car_park_zones.slot')
            ->addSelect('provinces.name_th as branch_province_name')
            ->leftjoin('car_colors', 'car_colors.id', '=', 'cars.car_color_id')
            ->leftjoin('car_classes', 'car_classes.id', '=', 'cars.car_class_id')
            ->leftjoin('car_types', 'car_types.id', '=', 'car_classes.car_type_id')
            ->leftjoin('car_brands', 'car_brands.id', '=', 'car_types.car_brand_id')
            ->leftJoinSub(get_sub_query_car_park_zones(), 'car_park_zones', function ($join) {
                $join->on('cars.id', '=', 'car_park_zones.car_id');
            })
            ->leftjoin('provinces', 'provinces.id', '=', 'car_park_zones.branch_province_id')
            ->where('cars.id', $car_id)
            //->where('cars.branch_id', get_branch_id())
            ->first();
        if ($car) {
            $car->rental_type_name = __('cars.rental_type_' . $car->rental_type);
            $car->display_name = null;
            if ($car->license_plate) {
                $car->display_name = $car->license_plate;
            } else if ($car->engine_no) {
                $car->display_name = __('inspection_cars.engine_no') . ' ' . $car->engine_no;
            } else if ($car->chassis_no) {
                $car->display_name = __('inspection_cars.chassis_no') . ' ' . $car->chassis_no;
            }
            $car->display_full_name = implode(' / ', array_filter([$car->license_plate, $car->engine_no, $car->chassis_no]));
        }
        return $car;
    }
}

if (!function_exists('get_rental_detail')) {
    function get_rental_detail($rental_id)
    {
        $rental = Rental::select('rentals.id', 'rentals.pickup_date', 'rentals.return_date')
            ->addSelect('rentals.origin_id', 'rentals.origin_remark', 'rentals.origin_lat', 'rentals.origin_lng', 'rentals.origin_name', 'rentals.origin_address')
            ->addSelect('rentals.destination_id', 'rentals.destination_remark', 'rentals.destination_lat', 'rentals.destination_lng', 'rentals.destination_name', 'rentals.destination_address')
            ->addSelect('branches.name as branch_name', 'service_types.id as service_type_id', 'service_types.name as service_type_name', 'products.name as product_name')
            ->leftJoin('branches', 'branches.id', '=', 'rentals.branch_id')
            // ->leftJoin('customers', 'customers.id', '=', 'rentals.customer_id')
            ->leftJoin('service_types', 'service_types.id', '=', 'rentals.service_type_id')
            ->leftJoin('products', 'products.id', '=', 'rentals.product_id')
            ->where('rentals.id', $rental_id)
            ->first();
        return $rental;
    }
}

if (!function_exists('getYesNoList')) {
    function getYesNoList()
    {
        return collect([
            [
                'id' => 1,
                'value' => 1,
                'name' => __('lang.yes'),
            ],
            [
                'id' => 0,
                'value' => 0,
                'name' => __('lang.no'),
            ],
        ]);
    }
}

if (!function_exists('getStatusList')) {
    function getStatusList()
    {
        return collect([
            [
                'id' => 1,
                'value' => 1,
                'name' => __('lang.status_' . STATUS_ACTIVE),
            ],
            [
                'id' => 0,
                'value' => 0,
                'name' => __('lang.status_' . STATUS_INACTIVE),
            ],
        ]);
    }
}

if (!function_exists('getDayCollection')) {
    function getDayCollection()
    {
        $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
        return collect($days)->map(function ($item) {
            return [
                'id' => $item,
                'name' => __('products.day_' . $item),
                'value' => $item,
            ];
        });
    }
}

// to be remove
if (!function_exists('generateRecordNumber')) {
    function generateRecordNumber($prefix, $number, $separator = true)
    {
        $format_number = strval(sprintf('%05d', $number));
        $year = strval(date('Y'));
        $month = strval(date('m'));
        $separator = $separator ? '/' : '';
        return $prefix . $year . $separator . $month . $separator . $format_number;
    }
}

if (!function_exists('generate_worksheet_no')) {
    function generate_worksheet_no($class_name, $support_branch = true)
    {
        // check ->withTrashed() for count number
        if (class_exists($class_name)) {
            $year = strval(date('Y'));
            $count = 0;
            if ($support_branch) {
                $count = $class_name::whereYear('created_at', $year)->where('branch_id', get_branch_id())->withTrashed()->count();
            } else {
                $count = $class_name::whereYear('created_at', $year)->withTrashed()->count();
            }
            $count++;
            $format_number = strval(sprintf('%05d', $count));

            $documents = config('document');
            $documents_prefix = $documents['prefix'];
            $documents_branch_prefix = $documents['branch_prefix'];
            $documents_branch_registered_code = $documents['branch_registered_code'];

            $prefix = isset($documents_prefix[$class_name]) ? $documents_prefix[$class_name] : '';

            $branch_prefix = '';
            $branch_registered_code = '';
            $branch = Branch::find(get_branch_id());
            if ($branch) {
                if (isset($documents_branch_prefix[$class_name])) {
                    $branch_prefix = $branch->document_prefix;
                }
                if (isset($documents_branch_registered_code[$class_name])) {
                    $branch_registered_code = $branch->registered_code;
                }
            }

            $separator_1 = isset($documents['custom_separator_1'][$class_name]) ? $documents['custom_separator_1'][$class_name] : '';
            $date_format = isset($documents['custom_date_format'][$class_name]) ? $documents['custom_date_format'][$class_name] : 'Ym';
            $separator_2 = isset($documents['custom_separator_2'][$class_name]) ? $documents['custom_separator_2'][$class_name] : '';

            return $prefix . $branch_prefix . $branch_registered_code . $separator_1 . date($date_format) . $separator_2 . $format_number;
        } else {
            return null;
        }
    }
}

if (!function_exists('str_limit')) {
    function str_limit($value, $limit = 10)
    {
        return Str::of($value)->limit($limit);
    }
}

if (!function_exists('price_format')) {
    function price_format($price, $text = false)
    {
        $price = floatval($price);
        return ((!$text) ? floatval(number_format($price, 2, '.', '')) : number_format($price, 2, '.', ','));
    }
}

if (!function_exists('price_format_human')) {
    function price_format_human($price)
    {
        $price = price_format($price, true);
        return str_replace('.00', '', $price);
    }
}

if (!function_exists('cal_vat')) {
    function cal_vat($price, $vat_percent = 7)
    {
        $price = abs(floatval($price));
        $vat_percent = abs(intval($vat_percent));
        return (($price * $vat_percent) / 100);
    }
}

if (!function_exists('bahtText')) {
    function bahtText(float $amount)
    {
        [$integer, $fraction] = explode('.', number_format(abs($amount), 2, '.', ''));

        $baht = convertBahtText($integer);
        $satang = convertBahtText($fraction);

        $output = $amount < 0 ? 'ลบ' : '';
        $output .= $baht ? $baht . 'บาท' : '';
        $output .= $satang ? $satang . 'สตางค์' : 'ถ้วน';

        return $baht . $satang === '' ? 'ศูนย์บาทถ้วน' : $output;
    }
}

if (!function_exists('convertBahtText')) {
    function convertBahtText(string $number): string
    {
        $values = ['', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า'];
        $places = ['', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน'];
        $exceptions = ['หนึ่งสิบ' => 'สิบ', 'สองสิบ' => 'ยี่สิบ', 'สิบหนึ่ง' => 'สิบเอ็ด'];

        $output = '';

        foreach (str_split(strrev($number)) as $place => $value) {
            if ($place % 6 === 0 && $place > 0) {
                $output = $places[6] . $output;
            }

            if ($value !== '0') {
                $output = $values[$value] . $places[$place % 6] . $output;
            }
        }

        foreach ($exceptions as $search => $replace) {
            $output = str_replace($search, $replace, $output);
        }

        return $output;
    }
}

if (!function_exists('getHoursBetweenDate')) {
    function getHoursBetweenDate($date1, $date2)
    {
        $hour = 0;
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);

        $interval = $date1->diff($date2);
        $interval_days = intval($interval->format('%a'));
        $interval_hours = intval($interval->format('%h'));
        if ($interval_days > 0) {
            $hour += ($interval_days * 24);
        }
        if ($interval_hours > 0) {
            $hour += $interval_hours;
        }
        return $hour;
    }
}

if (!function_exists('getDaysBetweenDate')) {
    function getDaysBetweenDate($date1, $date2)
    {
        $interval_days = 0;
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);

        $interval = $date1->diff($date2);
        $interval_days = intval($interval->format('%a'));
        return $interval_days;
    }
}

if (!function_exists('getDaysTimesBetweenDate')) {
    function getDaysTimesBetweenDate($date1, $date2)
    {
        $interval_days = 0;
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);

        $interval = $date1->diff($date2);

        $days = intval($interval->format('%a'));
        $hours = intval($interval->format('%h'));
        $minutes = intval($interval->format('%i'));

        if ($days <= 0) {
            $interval_days = $hours . "." . $minutes . " ชั่วโมง";
        } else if (($hours <= 0)) {
            $interval_days = $days . " วัน ";
        } else {
            $interval_days = $days . " วัน " . $hours . "." . $minutes . " ชั่วโมง";
        }

        return $interval_days;
    }
}

if (!function_exists('getPaymentCode')) {
    function getPaymentCode($Ref1 = null, $Ref2 = null, $amount = 0)
    {
        $TaxId = config('services.tax_id');
        $Suffix = config('services.suffix');
        // $Ref1 = 'ABC123456';
        // $Ref2 = '1234567989';
        $newBarcode = "|" . $TaxId . $Suffix . "\r" . $Ref1 . "\r" . $Ref2 . "\r" . $amount;
        return $newBarcode;
    }
}

if (!function_exists('calculateVat')) {
    function calculateVat(float $amount)
    {
        $cal_vat = ($amount * 7 / 107);
        // $vat = number_format($cal_vat, 2);
        $vat = floatval(number_format($cal_vat, 2, '.', ''));
        return $vat;
    }
}

if (!function_exists('getPriceExcludeVat')) {
    function getPriceExcludeVat(float $amount)
    {
        $exclude_vat_price = $amount * 100 / 107;
        return $exclude_vat_price;
    }
}

if (!function_exists('__log')) {
    function __log($string, $arr = [], $level = 'info', $channel = null)
    {
        $channel = (!empty($channel) ? $channel : config('logging.default'));
        return Log::channel($channel)->log($level, $string, $arr);
    }
}

if (!function_exists('get_name_month')) {
    function get_name_month($number)
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return $months[$number - 1];
    }
}

if (!function_exists('timeago')) {
    function timeago($date)
    {
        $timestamp = strtotime($date);

        $strTime = array("วินาที", "นาที", "ชั่วโมง", "วัน", "เดือน", "ปี");
        $length = array("60", "60", "24", "30", "12", "10");

        $currentTime = time();
        if ($currentTime >= $timestamp) {
            $diff = time() - $timestamp;
            for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
                $diff = $diff / $length[$i];
            }

            $diff = round($diff);
            return $diff . " " . $strTime[$i] . "ที่แล้ว";
        }
    }
}

if (!function_exists('get_user_notifications')) {
    function get_user_notifications()
    {
        $user = Auth::user();
        if (empty($user)) {
            return [];
        }
        $start_date = date('Y-m-d', strtotime('-21 days'));
        $notifications = $user->notifications()->whereDate('created_at', '>=', $start_date)->orderBy('created_at', 'desc')->limit(50)->get();
        $notifications = $notifications->map(function ($notification) {
            return [
                'id' => $notification->id,
                'title' => isset($notification->data['title']) ? $notification->data['title'] : '',
                'description' => isset($notification->data['description']) ? $notification->data['description'] : '',
                'url' => isset($notification->data['url']) ? $notification->data['url'] : '',
                'type' => isset($notification->data['type']) ? $notification->data['type'] : '',
                'datetime' => $notification->created_at,
                'readat' => $notification->read_at,
            ];
        });
        return $notifications;
    }
}

if (!function_exists('get_unread_user_notifications_count')) {
    function get_unread_user_notifications_count($notifications)
    {
        $count = collect($notifications)->filter(function ($notification) {
            return is_null($notification['readat']);
        })->count();
        return $count;
    }
}

if (!function_exists('get_total_exclude_vat')) {
    function get_total_exclude_vat($total_include_vat)
    {
        // vat = 7%
        return 'x';
    }
}

if (!function_exists('get_vat_from_total')) {
    function get_vat_from_total($total_include_vat)
    {
        // vat = 7%
        return 'y';
    }
}

if (!function_exists('getTrueValue')) {
    function getTrueValue($value)
    {
        return ($value && $value > 0) ? $value : null;
    }
}

if (!function_exists('find_name_by_id')) {
    function find_name_by_id($id, $class_name, $field_name = 'name')
    {
        if (class_exists($class_name)) {
            $object = $class_name::find($id);
            return $object ? $object->{$field_name} : null;
        } else {
            return null;
        }
    }
}

if (!function_exists('format_license_plate')) {
    function format_license_plate($string)
    {
        $string = str_ireplace(
            array(
                '\'',
                '"',
                ',',
                ';',
                '<',
                '>',
                '_',
                '+',
                '-',
                '!',
                '/',
            ),
            '',
            $string
        );
        $matches = null;
        preg_match_all("/[0-9]+/", $string, $matches);
        $start_number = mb_substr($string, 0, strpos($string, end($matches[0])) - strlen(end($matches[0])));
        $end_number = str_replace(mb_substr($string, 0, strpos($string, end($matches[0])) - strlen(end($matches[0]))), '', $string);
        return trim($start_number . '_' . $end_number, '_');
    }
}

if (!function_exists('set_view')) {
    function set_view($bool = true)
    {
        session()->flash('view', boolval($bool));
    }
}

if (!function_exists('is_view')) {
    function is_view()
    {
        return boolval(session('view'));
    }
}

if (!function_exists('validate_citizen')) {
    function validate_citizen($citizen)
    {

        $justNums = preg_replace("/[^0-9]/", '', $citizen);
        if (strcmp($justNums, $citizen) != 0) {
            return false;
        }

        if (!in_array(strlen($justNums), [13])) {
            return false;
        }

        for ($i = 0, $sum = 0; $i < 12; $i++) {
            $sum += (int)($justNums[$i]) * (13 - $i);
        }

        $check_citizen = (11 - ($sum % 11)) % 10 == (int)($justNums[12]);

        if ($check_citizen === false) {
            return false;
        }

        return true;
    }
}

if (!function_exists('validate_phone')) {
    function validate_phone($phone)
    {
        $justNums = preg_replace("/[^0-9]/", '', $phone);
        if (strcmp($justNums, $phone) != 0) {
            return false;
        }

        if (!Str::startsWith($phone, '0')) {
            return false;
        }

        if (!in_array(strlen($phone), [9, 10])) {
            return false;
        }

        return true;
    }
}

if (!function_exists('tel_format_in_array')) {
    function tel_format_in_array($data)
    {
        if (empty($data)) {
            return [];
        }
        foreach ($data as $key => $value) {
            foreach ($value as $key_2 => $value_2) {
                if (Str::contains($key_2, ['phone', 'tel'])) {
                    $data[$key][$key_2] = str_replace('-', '', $value[$key_2]);
                }
            }
        }
        return $data;
    }
}
