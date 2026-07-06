<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use App\Models\Client;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
      $makkah = City::firstOrCreate([
        'name' => $this->cleanText('مكة')
      ]);

    $bisha = City::firstOrCreate([
        'name' => $this->cleanText('بيشة')
    ]);

    $riyadh = City::firstOrCreate([
        'name' => $this->cleanText('الرياض')
    ]);


    $jeddah = City::firstOrCreate([
        'name' => $this->cleanText('جدة')
    ]);

    $asir = City::firstOrCreate([
        'name' => $this->cleanText('عسير')
    ]);


    $madinah = City::firstOrCreate([
        'name' => $this->cleanText('المدينة')
    ]);


       $clients = [
    ['name' => 'طه', 'id_number' => '4033499', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'محمد عبدالعاطى', 'id_number' => '4650498', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'عادل حجازي', 'id_number' => '4615455', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'صبري عبد المقصود', 'id_number' => '2483622', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'كمال اوسين', 'id_number' => '4553144', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'محمد تاغيا', 'id_number' => '2085967', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'علي السيد عالم', 'id_number' => '4614073', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'حسني محمد سعيد', 'id_number' => '4715417', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'احمد رافت', 'id_number' => '4033393', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'فيصل نواز', 'id_number' => '2160526', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'شاهد شاهين', 'id_number' => '2264661', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'غسان عبدالرحمن اليمني', 'id_number' => '4035923', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'شاه الدين', 'id_number' => '4211181', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'خالد سرحان', 'id_number' => '4389700', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'علي الجلوب', 'id_number' => '4442866', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'مد ازاد حسين', 'id_number' => '4504600', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'رقيب حسين', 'id_number' => '1430102', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'محمد عبدالخالق', 'id_number' => '4033530', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'غالم مرتضاء بشايا', 'id_number' => '4333452', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'احمد محمود احمد', 'id_number' => '4389691', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'كريم سميح ابراهيم', 'id_number' => '4513082', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'شاكر الجلوب', 'id_number' => '4328166', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'محمد عرفان', 'id_number' => '2136414', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'اسامة الاسد', 'id_number' => '4133069', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'وسيم حسن', 'id_number' => '4171917', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'مان رياش', 'id_number' => '4340518', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'محمد عمران', 'id_number' => '2153295', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'محمد سراج', 'id_number' => '2164446', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'مد منوار اوسين', 'id_number' => '4415830', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'زوهيب شاكل', 'id_number' => '2153300', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'عبد ال رمان', 'id_number' => '4506867', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'محمد عاصم نسيم', 'id_number' => '4353225', 'city_id' => $makkah->id, 'status' => 'inactive'],

    // دبابات مكة
    ['name' => 'احمد حجازي', 'id_number' => '2068528', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'سمير فوزي', 'id_number' => '2485583', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'مهزر حسین', 'id_number' => '2155884', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'خلف محمد', 'id_number' => '2471612', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'السيد محسن الشحات', 'id_number' => '4638847', 'city_id' => $makkah->id, 'status' => 'active'],
    ['name' => 'احمد مصطفي', 'id_number' => '2434013', 'city_id' => $makkah->id, 'status' => 'active'],
    [
    'name' => 'اسلام رضا',
    'id_number' => '2479134',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد شاكل',
    'id_number' => '2145427',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمود الزق',
    'id_number' => '2420719',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد عبد الحافظ',
    'id_number' => '2203168',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'احمد جمعه',
    'id_number' => '2597123',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد انصار',
    'id_number' => '2090788',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد نعيم الميكانيكي (عمار عرابي)',
    'id_number' => '2118459',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمود عاشور',
    'id_number' => '2479159',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'هادي عبدالعزيز',
    'id_number' => '2597151',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'تانفير احمد',
    'id_number' => '2078840',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد محمود حمص',
    'id_number' => '3837622',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'ذكي عرابي',
    'id_number' => '3920268',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'وسيم عبده ثابت',
    'id_number' => '4535036',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'عمران شير',
    'id_number' => '2187246',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد اسلام',
    'id_number' => '2269970',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد رحيب',
    'id_number' => '2379266',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد فياض',
    'id_number' => '2427484',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد منصور اليمني',
    'id_number' => '3909026',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'مهيم مطهر حسين',
    'id_number' => '4609306',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمود العشماوي',
    'id_number' => '2203195',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد بخش (محمد عدنان)',
    'id_number' => '2378797',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد إبراهيم حمص',
    'id_number' => '3835868',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'يوسف خلف',
    'id_number' => '2271279',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'انتظار حسین',
    'id_number' => '2402106',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'يوسف العزب',
    'id_number' => '2426267',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'احمد رمضان',
    'id_number' => '2479192',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'مد آ كاش برا مانيك',
    'id_number' => '4609317',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'عبد الرؤوف سعيد',
    'id_number' => '2160512',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'ابراهيم الدسوقى',
    'id_number' => '2203155',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'بهاء حمص',
    'id_number' => '2203171',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'احمد حمص',
    'id_number' => '2203173',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد نبيل (زاهد حسين)',
    'id_number' => '3808425',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'جمال اسماعيل',
    'id_number' => '4223992',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'مد رحمن (مد مران)',
    'id_number' => '4242858',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'مصطفي السيد السعدني',
    'id_number' => '4534986',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'وليد محمد',
    'id_number' => '2468050',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'بسام مهيوب',
    'id_number' => '3518777',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'عبدالرحمن رضا',
    'id_number' => '4039744',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'طه بدوي (مد فازا)',
    'id_number' => '2220112',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'فواز المقراني',
    'id_number' => '4281959',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'سيد سلطان سياي',
    'id_number' => '4691111',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'محمد مدبولي (محمد شبير رحمن)',
    'id_number' => '2263128',
    'city_id' => $makkah->id,
    'status' => 'active',
],
// مكة
[
    'name' => 'اصف علي (مد بشير بابي)',
    'id_number' => '2153294',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'امير نزار',
    'id_number' => '2185227',
    'city_id' => $makkah->id,
    'status' => 'active',
],
[
    'name' => 'عبدالله قيوم (مد مران)',
    'id_number' => '2427463',
    'city_id' => $makkah->id,
    'status' => 'inactive',
],
[
    'name' => 'بسام عويس (زاهد حسين)',
    'id_number' => '2069595',
    'city_id' => $makkah->id,
    'status' => 'inactive',
],
[
    'name' => 'احمد حمدي السعدني',
    'id_number' => '4712224',
    'city_id' => $makkah->id,
    'status' => 'inactive',
],



// بيشة
[
    'name' => 'محمد بلال (نجم الدين الشامي)',
    'id_number' => '1594583',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'هشام عبدالله اليماني',
    'id_number' => '4416900',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'طارق صديق (ابويزن اليمني)',
    'id_number' => '153393',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'محمد عزام الشقاقي',
    'id_number' => '4706741',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'عمر رياض علي حيدر',
    'id_number' => '2255210',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'محمد صارف اعجاز (محمد ابراهيم الزنداني)',
    'id_number' => '4581857',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'محمد علي ضبعان',
    'id_number' => '4431366',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'يوسف علي',
    'id_number' => '1878568',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'جول خان',
    'id_number' => '2266525',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'حمادة صالح',
    'id_number' => '3820850',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'مصطفي حسن (حزيفة الريمي)',
    'id_number' => '4281906',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'عبدالله عبدالعليم (محمد عبدالرحمن)',
    'id_number' => '4328981',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'مد ريمون',
    'id_number' => '1789537',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'عبدالرحيم دسوقي (بارفاج موشاروف)',
    'id_number' => '4324824',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'عاطف حسين ياسين (جار الله النيني)',
    'id_number' => '4591149',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'مد عبدول مهدي',
    'id_number' => '4638788',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'غالم عباس نزار (فرج العولقي)',
    'id_number' => '4373848',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'محمد اصف باطي (عبدالله ناجي الماربي)',
    'id_number' => '3785734',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'شهيد شبير (رياض الاهدل)',
    'id_number' => '4278811',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'فاروق احمد حسين (فريد مياه)',
    'id_number' => '4523212',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'محمد نبيل صالح الجلوب',
    'id_number' => '2825207',
    'city_id' => $bisha->id,
    'status' => 'inactive',
],
[
    'name' => 'امتياز حسين حسين (زياد البري)',
    'id_number' => '4526000',
    'city_id' => $bisha->id,
    'status' => 'inactive',
],
[
    'name' => 'خورام شهزاد حسين (فرهد حسين)',
    'id_number' => '4513367',
    'city_id' => $bisha->id,
    'status' => 'inactive',
],
[
    'name' => 'تجميل حسين غالم (محمد ياسين ارا)',
    'id_number' => '4233768',
    'city_id' => $bisha->id,
    'status' => 'inactive',
],
[
    'name' => 'محمد ادريس علي (مجيب محمد المليكي)',
    'id_number' => '4373859',
    'city_id' => $bisha->id,
    'status' => 'active',
],
[
    'name' => 'محمد عاطف',
    'id_number' => '2192776',
    'city_id' => $bisha->id,
    'status' => 'inactive',
],
[
    'name' => 'حق نواز بخش (معتز صالح)',
    'id_number' => '4039815',
    'city_id' => $bisha->id,
    'status' => 'inactive',
],
[
    'name' => 'منيراحمد',
    'id_number' => '4054613',
    'city_id' => $bisha->id,
    'status' => 'inactive',
],
[
    'name' => 'مصطفي عابدين (فرج قاسم كباش)',
    'id_number' => '4415816',
    'city_id' => $bisha->id,
    'status' => 'inactive',
],
[
    'name' => 'محمد عبدالرحيم الماحي (عماد قاسم المسيب)',
    'id_number' => '4492012',
    'city_id' => $bisha->id,
    'status' => 'active',
],


// الرياض
[
    'name' => 'مد ميالنور رحمان',
    'id_number' => '4604625',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'خالد حماد بندق',
    'id_number' => '4715260',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'مصطفي الميكانيكي (محمد شعبان)',
    'id_number' => '2160981',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
// الرياض
[
    'name' => 'محمد عصام عبدالحميد',
    'id_number' => '4714646',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'مد عاشق',
    'id_number' => '4293601',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'مد معصوم بالله',
    'id_number' => '4604568',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'محمد خيري احمد',
    'id_number' => '4727746',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'احمد السيد سليمان',
    'id_number' => '4727765',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'شجون عثمان علي',
    'id_number' => '4715426',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'عباد الله ساجد الله',
    'id_number' => '4718508',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'عتيق روريمان خان',
    'id_number' => '4715201',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'تعريف الاسلام مد كالو',
    'id_number' => '2023920',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'مد امين الله',
    'id_number' => '4715344',
    'city_id' => $riyadh->id,
    'status' => 'active',
],
[
    'name' => 'اقبال محمد نور الهي',
    'id_number' => '3785284',
    'city_id' => $riyadh->id,
    'status' => 'inactive',
],
[
    'name' => 'عبدالمنعم حسن',
    'id_number' => '3517753',
    'city_id' => $riyadh->id,
    'status' => 'inactive',
],
[
    'name' => 'احسان عمران نزار احمد',
    'id_number' => '3785651',
    'city_id' => $riyadh->id,
    'status' => 'inactive',
],
[
    'name' => 'مد محسن تشودري',
    'id_number' => '4347466',
    'city_id' => $riyadh->id,
    'status' => 'inactive',
],
[
    'name' => 'مولزم حسين باكشه',
    'id_number' => '4626404',
    'city_id' => $riyadh->id,
    'status' => 'inactive',
],
[
    'name' => 'مد ميهال بيك',
    'id_number' => '4609314',
    'city_id' => $riyadh->id,
    'status' => 'inactive',
],
[
    'name' => 'محمد إسحاق',
    'id_number' => '2192753',
    'city_id' => $riyadh->id,
    'status' => 'inactive',
],
[
    'name' => 'أيوب الفهد (سيف الزمان)',
    'id_number' => '3517757',
    'city_id' => $riyadh->id,
    'status' => 'active',
],


// جدة
[
    'name' => 'وقاص حيدر',
    'id_number' => '2093266',
    'city_id' => $jeddah->id,
    'status' => 'active',
],
[
    'name' => 'مقصود احمد',
    'id_number' => '2086013',
    'city_id' => $jeddah->id,
    'status' => 'active',
],
[
    'name' => 'محمد زبير',
    'id_number' => '4347484',
    'city_id' => $jeddah->id,
    'status' => 'active',
],
[
    'name' => 'كيزا',
    'id_number' => '3993046',
    'city_id' => $jeddah->id,
    'status' => 'active',
],
[
    'name' => 'شهزاد نزار حسين',
    'id_number' => '4494188',
    'city_id' => $jeddah->id,
    'status' => 'active',
],
[
    'name' => 'أنيت الله',
    'id_number' => '2118431',
    'city_id' => $jeddah->id,
    'status' => 'active',
],
[
    'name' => 'سقلين عباس شاد',
    'id_number' => '4354277',
    'city_id' => $jeddah->id,
    'status' => 'active',
],
[
    'name' => 'مصطفى باكش',
    'id_number' => '2100537',
    'city_id' => $jeddah->id,
    'status' => 'active',
],
[
    'name' => 'جاويد اقبال شفيع',
    'id_number' => '1435005',
    'city_id' => $jeddah->id,
    'status' => 'inactive',
],


[
    'name' => 'محمود بكري مشعل',
    'id_number' => '4653420',
    'city_id' => $madinah->id,
    'status' => 'inactive',
],



[
    'name' => 'منذر حسن (مصطفى كمال البنقالي)',
    'id_number' => '4325288',
    'city_id' => $asir->id,
    'status' => 'inactive',
],
];

foreach ($clients as $client) {
    Client::updateOrCreate(
        ['id_number' => $this->cleanText($client['id_number'])],
        [
            'name' => $this->cleanText($client['name']),
            'id_number' => $this->cleanText($client['id_number']),
            'city_id' => $client['city_id'],
            'status' => $client['status'],
        ]
    );
}
    }
private function cleanText(?string $text): ?string
{
    if ($text === null) {
        return null;
    }

    return trim(
        preg_replace(
            '/[\x{200B}-\x{200F}\x{202A}-\x{202E}\x{2066}-\x{2069}\x{FEFF}]/u',
            '',
            preg_replace('/\s+/u', ' ', $text)
        )
    );
}


}