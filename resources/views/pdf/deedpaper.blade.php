<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="{{ public_path().'/css/deedpaper.css' }}">

<style type="text/css">
	body {
		font-size:14px;
		line-height:22px;
		font-weight:bold;
		font-family:'bangla-bold', sans-serif;
	}
	.cTr{
		width: 100%;
	}
	.fl{
		float: left;
	}
	.bbt{
		font-size: 12px;
		font-family:english;
		border-bottom:2px dotted #000;
	}
	.bb{ border-bottom:1px dotted #000;}

</style>

</head>
<body>
	<div style="height:150px">&nbsp;</div>
	<h1 class="text-center mainTitle"><span>ডিপ ফ্রিজের চুক্তি পত্র</span></h1>
	<div class="pb-50">ঢাকা আইস্ক্রীম ইন্ডাষ্ট্রিজ লিঃ একটি ব্যক্তিমালিকানাধীন দায়বদ্ধ কোম্পানী যাহা ১৯৯৪ ইং সনের বাংলাদেশ কোম্পানী আইনে রেজিষ্ট্রিকৃত এবং যাহার রেজিষ্ট্রিকৃত অফিস ৮০,শহীদ তাজউদ্দীন আহম্মদ সরনী তেজগাঁও শিল্প এলাকা ঢাকা-১২০৮ ঠিকানায় অবস্থিত (অতঃপর এই চুক্তিনামায় "কোম্পানী" নামে অভিহিত)।</div>

    <div class="text-right pb-sm">
    	<span>................প্রথম পক্ষ</span>
    </div>
    <div style="height:20px">&nbsp;</div>
	<div class="cTr pb-10">
	    <div class="fl" style="width:6%;">মেসার্সঃ</div>
		<div class="fl bbt" style="width:32%;">{{$reqisition->shop->outlet_name}}</div>
		<div class="fl" style="width:15%;">প্রতিষ্ঠানের ঠিকানাঃ</div>
		<div class="fl bbt" style="width:47%;">{!! $reqisition->shop->address ?? '&nbsp;' !!}</div>
	</div>
	<div class="cTr pb-10">
	    <div class="fl" style="width:10%;">স্বত্বাধীকারীঃ</div>
		<div class="fl bbt" style="width:50%">{{$reqisition->shop->proprietor_name}}</div>
		<div class="fl" style="width:12%">ফোন/মোবাইলঃ</div>
		<div class="fl bbt" style="width:26%">{{$reqisition->shop->mobile}}</div>
	</div>
    <div class="cTr pb-10">
	    <div class="fl" style="width:19%;">বর্তমান (বাসার)ঠিকানাঃ</div>
		<div class="fl bbt" style="width:81%;">{{$reqisition->shop->present_address}}</div>
	</div>
    <div class="cTr pb-10">
	    <div class="fl" style="width:11%;">স্থায়ী  ঠিকানাঃ</div>
		<div class="fl bbt" style="width:89%;">{{$reqisition->shop->parmanent_address}}</div>
	</div>
    <div class="cTr pb-10">
	    <div class="fl" style="width:100%;">(অতঃপর এই চুক্তিনামায় "পরিবেশক/বিক্রেতা" নামে অভিহিত)।</div>
	</div>
    <div style="height:100px">&nbsp;</div>
    <div class="text-right pb-sm">
    	<span>.....................দ্বিতীয় পক্ষ</span>
    </div>
    <div class="cTr pb-10">
	    <div class="fl" style="width:100%;">
        	যেহেতু কোম্পানী (প্রথম পক্ষ) তাহার ঢাকার তেজগাঁও শিল্প এলাকায় অবস্থিত নিজস্ব কারখানায় আন্তর্জাতিক মান  সম্পন্ন পোলার  আইসক্রীম (অতঃপর "পন্য") উৎপাদন করে এবং পরিবেশক/বিক্রেতার মাধ্যমে বাজারজাত করে এবং যেহেতু এই আইসক্রীম পন্য খাদ্যমান অনুযায়ী সংরক্ষন করার প্রয়োজনীয়তা উপলব্ধি করে এবং যেহেতু পরিবেশক/ বিক্রেতা (দ্বিতীয় পক্ষ) কোম্পানী (প্রথম পক্ষ) হতে জামানত /  মাসিক সার্ভিস চার্জের ভিত্তিতে একটি ডিপফ্রিজ উপরে উল্লেখিত ঠিকানায় স্থাপন করার ইচ্ছা প্রকাশ করে, কোম্পানী ব্যবসায়ীক স্বার্থে এবং পণ্যের মান অবিকৃত রাখার নিমিত্তে পরিবেশক/বিক্রেতাকে নিম্নে বর্ণিত শর্ত সাপেক্ষে ডিপফ্রিজটি সরবরাহ করতে সম্মতি প্রকাশ করে, যেহেতু পরিবেশক/বিক্রেতা কোম্পানীর শর্তে তার ব্যবসায়িক এবং পন্য সংরক্ষণের স্বার্থে একটি ডিপফ্রিজ গ্রহণ করার ইচ্ছা প্রকাশ করে সেহেতু উভয়ের সম্মতিক্রমে এই চুক্তিপত্র স্বাক্ষরিত হল।
        </div>
	</div>
    <div class="page-break"></div><!--Breack First Page-->


    <div style="height:150px">&nbsp;</div>
    <h1 class="text-center mainTitle"><span>কোম্পানীর শর্তাবলী</span></h1>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">১। </div>
	    <div class="fl" style="width:97%;">কোম্পানী (প্রথম পক্ষ) নির্ধারিত হারে জামানত ও অগ্রিম সার্ভিস চার্জের টাকা সম্পূর্ণ বুঝে পাওয়ার পর এবং চুক্তিপত্র স্বাক্ষরিত হবার পর নিজ খরচে বিক্রেতা/পরিবেশকের দোকানে অনতিবিলম্বে ১টি  ডিপফ্রিজ স্থাপন  করে  দিবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">২। </div>
	    <div class="fl" style="width:97%;">ডিপফ্রিজের বিবরণঃ ব্র্যান্ড <span class="bbt"> {{$item->brand->short_code}} </span> সাইজ <span class="bbt">{{$item->size->name}}</span> তৈরীর স্থান <span class="bbt">{!! isset($orgins->country_name)?$orgins->country_name:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'!!}</span> কোড নং <span class="bbt">{{$item->serial_no}}</span></div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৩। </div>
	    <div class="fl" style="width:97%;">
            ডিপফ্রিজের মাসিক সার্ভিসচার্জঃ টাকা <span class="bbt">{{number_format($settlement->receive_amount,2)}}</span>
            (কথায়) <span class="bbt">{{number_to_word( $settlement->receive_amount )}}</span> টাকা
            মাসিক মোট অগ্রিম সার্ভিস চার্জ <span class="bbt">{{$settlement->installment}}</span>
            টাকা, ফ্রিজের বর্তমান মূল্য <span>....................</span>টাকা
            (কথায়) <span>.......................................................................।</span>

        </div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৪। </div>
	    <div class="fl" style="width:97%;">
            ডিপফ্রিজ স্থাপনের  তারিখঃ <span class="bbt">{{$settlement->inject_date->format('d-M-Y')}}</span>,চুক্তির মেয়াদঃ<span class="bbt"> {{$settlement->receive_amount >0 ?$settlement->receive_amount/$settlement->installment:0}} Month | </span> সাধারনত জামানত / সার্ভিস চার্জ  হিসেবে গ্রহনকৃত টাকার পরিমান অনুযায়ী চুক্তির মেয়াদ নির্ধারন করা হবে ।

        </div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৫। </div>
	    <div class="fl" style="width:97%;">প্রতি বছর শীত মৌসুমে (নভেম্বর-জানুয়ারী) সার্ভিসিং করার জন্য ডিপফ্রিজটি কোম্পানী তাহার ওয়ার্কশপে আনবে এবং সার্ভিসিং করবার পর ডিপফ্রিজটি কোম্পানী নিজ দ্বায়িত্বে বিক্রেতা/পরিবেশকের দোকানে পৌছে দিবে। ইহা ছাড়াও বিক্রেতা /পরিবেশকের নিকট হতে ফ্রিজ সংক্রান্ত কোন অভিযোগ পাওয়া মাত্র কোম্পানী তাহার নিজস্ব মেকানিক প্রেরণ করে মেরামত কাজ সম্পন্ন করে দিবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৬।	 </div>
	    <div class="fl" style="width:97%;">যদি ডিপফ্রিজটির স্থায়ী কোন অসুবিধা দেখা দেয় এবং মেরামতের অযোগ্য বলে বিবেচিত হয় তাহা হলে কোম্পানী তাহার নিকট  মওজুদ থাকলে ডিপফ্রিজটি বদলাইয়া দিবে। অতিরিক্ত ডিপফ্রিজ মওজুদ না থাকলে পুনঃমেরামতের মাধ্যমে ইহাকে চালু রাখবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৭। </div>
	    <div class="fl" style="width:97%;">ডিপফ্রিজ এর মালিকানা কোম্পানী  হওয়াতে ডিপফ্রিজ সংক্রান্ত যাবতীয় নীতিমালা ও মাসিক সার্ভিস চার্জ নির্ধারণ বা পুনঃনির্ধারণ সম্পূর্ণ
         কোম্পানীর এখতিয়ারভুক্ত থাকবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৮। </div>
	    <div class="fl" style="width:97%;">হরতাল প্রাকৃতিক দুর্যোগ বা বিশেষ কোন উল্লেখযোগ্য কারনে (যাহা কোম্পানীর আওতা বর্হিভুত) পন্য সরবরাহ বিঘ্নিত হলে কোম্পানী কোন দায় দায়িত্ব বহন করবে না।</div>
	</div>
    <div class="page-break"></div><!--Breack Second Page-->


    <div style="height:70px">&nbsp;</div>
    <h1 class="text-center mainTitle"><span>পরিবেশক/বিক্রেতার শর্তাবলী</span></h1>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">১। </div>
	    <div class="fl" style="width:97%;">কোম্পানী  কর্তৃক  ডিপফ্রিজ  সরবরাহ করার পূর্বে কোম্পানী কর্তৃক নির্ধারিত জামানত  অথবা  কমপক্ষে <span class="bbt">{{$settlement->receive_amount >0 ?$settlement->receive_amount/$settlement->installment:0}}  Month</span> বছরের অগ্রীম সার্ভিস চার্জের সমুদয় টাকা পরিশোধ করতে  হবে। অগ্রিম সার্ভিস চার্জের সমুদয় টাকা সমন্বয় হওয়ার কমপক্ষে ১ (এক) মাস পূর্বে পুনরায় ডিপফ্রিজের অনুকুলে ১(এক) বছরের অগ্রিম সার্ভিস চার্জ প্রদান পূর্বক চুক্তির ধারাবাহিকতা রক্ষা করতে হবে।কোম্পানীর সহিত সকল আর্থিক লেনদেনে যথাযথ রশীদ গ্রহণ করবে।
        মাসের কোন ভগ্নাংশের জন্য পূর্ণ সার্ভিস চার্জ দিবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">২। </div>
	    <div class="fl" style="width:97%;">ডিপফ্রিজটি কখনই ক্রটিযুক্ত বৈদ্যুতিক  লাইনে  সংযোগ দেওয়া  যাবে না। ডিপফ্রিজ  সংযোগ স্থলে ভোল্টেজ সমস্যা থাকলেডিপফ্রিজের নিরাপত্তার কারনে কোম্পানী কর্তৃক অনুমোদিত সার্কিটব্রেকার
         পরিবেশক/বিক্রেতা কর্তৃক নিজ খরচে স্থাপন করবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৩। </div>
	    <div class="fl" style="width:97%;">কান কারন বসতঃ দ্বিতীয় পক্ষ তার ব্যবসা প্রতিষ্ঠানের নাম/স্থান পরিবর্তন করলে ১ম পক্ষকে অবশ্যই অবহিত করবে। অন্যথায় ভবিষ্যতে কোন সমস্যা সৃস্টি হলে তাহার দ্বায়ভার দ্বিতীয় পক্ষের উপর বর্তাবে ।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৪। </div>
	    <div class="fl" style="width:97%;">ডিপফ্রিজের সুষ্ঠ মেরামত ও পরিচালন সংক্রান্ত পরামর্শ সহ কোম্পানী কর্তৃক একটি "মেইন্টেনেন্স কার্ড" প্রদান করা হবে যাহা  ঠিকমত সংরক্ষণ করতে হবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৫। </div>
	    <div class="fl" style="width:97%;">চুক্তিকালে এই ডিপফ্রিজে পোলার আইসক্রীম ব্যতিত অন্য কোন আইসক্রীম বা অন্য পন্য রাখা যাবে না। ডিপফ্রিজটি এমন জায়গায় স্থাপন করবে যেন সর্বসাধারনের গোচরীভূত হয়।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৬। </div>
	    <div class="fl" style="width:97%;">প্রদত্ত ডিপফ্রিজটি যেহেতু বিক্রেতা / পরিবেশকের তত্ত্বাবধানে থাকবে সেহেতু ইহার সুষ্ঠু সংরক্ষণ ও পরিচালনার দায়িত্ব বিক্রেতা / পরিবেশকের উপর বর্তাবে। কোন কারনে ডিপফ্রিজ
         চুরি হলে কিংবা চুক্তি বর্হিভূত পন্য রাখার কারনে নষ্ট হলে অথবা বিক্রেতা / পরিবেশকের  অসাবধানতার কারণে নষ্ট হলে বিক্রেতা / পরিবেশককে ডিপফ্রিজের পূর্ণ মূল্য (যাহা উল্লেখ আছে) পরিশোধ করতে হবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৭। </div>
	    <div class="fl" style="width:97%;">যেহেতু ডিপফ্রিজটির মালিকানা কোম্পানী  সংরক্ষণ করে সেহেতু কোন অবস্থাতেই ডিপফ্রিজটি কোম্পানীর অনুমতি ছাড়া  স্থানান্তর /
        হ¯্তান্তর এবং বিক্রয় করা  যাবে না ।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৮। </div>
	    <div class="fl" style="width:97%;">বাৎসরিক সার্ভিসিং ছাড়াও মেরামতের জন্য যদি কখনও ডিপফ্রিজটি কোম্পানীর ওয়ার্কশপে আনার প্রয়োজন দেখা দেয়, পরিবেশক/
        বিক্রেতা সেই ব্যাপারেকোন বাধা সৃষ্টি করতে পারবে না। কোন অবস্থাতেই বাহিরের কোন মেকানিক দ্বারা ডিপফ্রিজটি  মেরামত করতে
       পারবে  না। ওয়ার্কশপে যদি ডিপফ্রিজটি ১৫ (পনের) দিনের বেশী থাকে, তাহা হলে সেই মাসের  ার্ভিস চার্জ মওকুফ করা হবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৯। </div>
	    <div class="fl" style="width:97%;">পরিবেশক/বিক্রেতা যদি ডিপফ্রিজটি সুষ্ঠুভাবে সংরক্ষণ করতে ব্যর্থ হন বা অগ্রিম সার্ভিস চার্জ সময়মত প্রদান করে  নির্ধারিত সময়ে চুক্তি নবায়ন না করে অথবা কোম্পানীর পন্য ছাড়া অন্যকোন পন্য ডিপফ্রিজে রাখে বা বিক্রির পরিমাণ কোম্পানীর বিচারে সন্তোষজনক নয়  বলে  বিবেচিত হয়। তাহা হলে কোম্পানী ডিপফ্রিজটি ফেরৎ আনবার অধিকার সংরক্ষণ করে। এই ব্যাপারে পরিবেশক/বিক্রেতা কোন ওজর  আপত্তি উত্থাপন করতে পারবে না।ডিপফ্রিজটি কোম্পানীর কাছে হস্তান্তর করবার পর পরিবেশক/ বিক্রেতা অগ্রিম সার্ভিস চার্জের বাকী টাকা
       ফেরত পাওয়ার জন্য আবেদন করবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">১০। </div>
	    <div class="fl" style="width:97%;">পরিবেশক/বিক্রেতার নিজের অসাবধানতার কারণে বা বিদ্যুৎ না থাকার কারণে যদি কোন পন্য গলিয়া যায় বা নষ্ট হয়ে যায় সেই  জন্য পরিবেশকই/ বিক্রেতাই দায়ী থাকবে। কোন অবস্থাতেই পরিবেশক/বিক্রেতা গলিত বা খাওয়ার অযোগ্য কোন আইসক্রীম বিক্রি করতে পারবে না।    </div>
	</div>
    <div class="page-break"></div><!--Breack Second Page-->


    <div style="height:50px">&nbsp;</div>
    <h1 class="text-center mainTitle"><span>বিবাদ নিষ্পওি ও চুক্তি বাতিল</span></h1>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">১। </div>
	    <div class="fl" style="width:97%;">পরিবেশক/বিক্রেতার সহিত কোন কারণে কোম্পানীর যদি কোন বিবাদের সূচনা হয়, তবে উভয় পক্ষ প্রথমে নিজেরা বসে তাহা সমাধানের   পদক্ষেপ নিবে। বিবাদ নিস্পত্তি না ঘটলে উভয়ের নিকট গ্রহণযোগ্য কোন সালিশের মাধ্যমে উক্ত বিবাদ নিস্পত্তি করবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">২। </div>
	    <div class="fl" style="width:97%;">যদি পরিবেশক/বিক্রেতা কোন সময় এই চুক্তি বাতিল করে তাহা হলে ডিপফ্রিজটি সম্পূর্ণ চালু অবস্থায় ফেরত দিতে হবে। অন্যথায় ডিপফ্রিজের পুরো মূল্য পরিবেশককে/বিক্রেতাকে দিতে হবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">৩। </div>
	    <div class="fl" style="width:97%;"> একমাসের নোটিশ প্রদান করে যে কোন সময় কোম্পানী বা পরিবেশক/বিক্রেতা এই চুক্তি বাতিল করতে পারবে  তবে  নির্ধারিতসময়ে  অগ্রিম সার্ভিস চার্জ প্রদান পূর্বক চুক্তি নবায়ন না করলে
         ইহা বাতিল বলে গণ্য হবে।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">&nbsp;</div>
	    <div class="fl" style="width:97%;">পরিবেশক/বিক্রেতা এই চুক্তিপত্র পড়ে এবং অনুধাবন করে সুস্থ্য মস্তিস্কে ও স্বজ্ঞানে নিুলিখিত স্বাক্ষীবর্গের উপস্থিতিতে অদ্য <span>...................</span> ইং তারিখে চুক্তিনামায় স্বাক্ষর প্রদান করলেন।</div>
	</div>
    <div class="cTr pb-sm">
    	<div class="fl" style="width:3%;">&nbsp;</div>
	    <div class="fl" style="width:97%;">ঢাকা আইস্ক্রীম ইন্ডাষ্ট্রিজ লিঃ <br>
       এর পক্ষে:</div>
	</div>
    <div style="height:60px">&nbsp;</div>
    <div class="cTr pb-sm">
    	<div class="fl text-center" style="width:50%;">

            <div class="fl" style="width:90%;">চুক্তিসম্পাদনকারী</div>
            <div class="fl bbt" style="width:90%">{{$reqisition->user->name}}</div>
            <div class="fl bbt" style="width:90%">{{$reqisition->user->designation->title}}</div>
            <br>
            স্বাক্ষর..........................................................|
        </div>
        <div class="fl text-center" style="width:50%;">
            <div class="fl" style="width:100%;">পরিবেশক/ বিক্রেতা</div>
            <div class="fl bbt" style="width:100%">{{$reqisition->shop->proprietor_name}}</div>
            <div class="fl bbt" style="width:100%"> {{$reqisition->shop->outlet_name}}</div>
            <br>
            স্বাক্ষর..........................................................|
        </div>
	</div>
    <div style="height:100px">&nbsp;</div>
    <div class="cTr pb-sm">
    	<div class="fl text-center" style="width:50%;">
             স্বাক্ষীঃ <br>
             ১। ..........................................................<br>
             ২। ..........................................................<br>
             ৩। ..........................................................<br>
        </div>
        <div class="fl text-center" style="width:50%;">
        	 স্বাক্ষরঃ<br>
             ১। ..........................................................<br>
             ২। ..........................................................<br>
             ৩। ..........................................................<br>
        </div>
	</div>


</body>
</html>
