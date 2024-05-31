<?php

use Illuminate\Database\Seeder;

class SmsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('sms')->insert([
			[
				'subject' => 'complain_received_confirmation_SMS_for_shop_owner',
				'message' => 'Dear valuable customer <!--proprietor_name-->, Outlet: <!--outlet_name-->, your complain "<!--df_problem-->" received by polar customer service department. We will resolve it shortly. Thanks, Polar Ice-cream',
				'is_designation_wise' => 0,
				'action' => 'problemEntry',
			],
			[
				'subject' => 'new_complain_SMS_for_teamleader',
				'message' => 'Date: <!--created_date-->, Time: <!--created_time-->, Outlet Name: <!--outlet_name-->, Address:  <!--address-->, Mobile: <!--mobile-->, Problem: <!--df_problem-->, DF Size: <!--df_size-->, DF code: <!--df_code-->, Depot: <!--depot-->, Region: <!--region-->. Thanks, <!--sender-->',
				'is_designation_wise' => 1,
				'action' => 'problemEntry',
			],
			[
				'subject' => 'complain_SMS_for_assigned_technician',
				'message' => 'Date: <!--created_date-->, Time: <!--created_time-->, Outlet Name: <!--outlet_name-->,  Address: <!--address-->, Mobile: <!--mobile-->, Problem: <!--df_problem-->, DF Size: <!--df_size-->, DF Code: <!--df_code-->, Depot: <!--depot-->, Region: <!--region-->. Thanks, <!--sender-->',
				'is_designation_wise' => 0,
				'action' => 'assignTechnician',
			],
			[
				'subject' => 'complain_resolved_SMS_for_shop_owner',
				'message' => 'Dear valuable customer <!--proprietor_name-->, Outlet: <!--outlet_name-->, your complain "<!--df_problem-->" has been resolved by polar service department. For further clarification please let us know. Thanks, Polar Ice-cream',
				'is_designation_wise' => 0,
				'action' => 'problemEntryEdit_for_complete',
			],
			[
				'subject' => 'complain_resolved_SMS_for_executive',
				'message' => 'Dear Mr. <!--sender-->, The complain for the "<!--outlet_name-->" DF Size: <!--df_size-->, DF Code: <!--df_code-->, has been resolved. Please inform your outlet owner. Thanks, Polar Ice-cream',
				'is_designation_wise' => 0,
				'action' => 'problemEntryEdit_for_complete',
			],
			[
				'subject' => 'need_to_pull_sms_for_shop_owner',
				'message' => 'Dear valuable customer <!--proprietor_name-->, Outlet: <!--outlet_name-->, your complain "<!--df_problem-->" has not resolved on spot and we need to pulled up the DF into our workshop. Polar responsible person will communicate with you soon. Thanks, Polar Ice-cream',
				'is_designation_wise' => 0,
				'action' => 'problemEntryEdit_for_pull',
			],
			[
				'subject' => 'df_return_application_approved_sms_for_shop_owner',
				'message' => 'Dear valuable customer <!--proprietor_name-->, Outlet: <!--outlet_name-->, your return application has been approved for DF Code: <!--df_code--> . Your payable amount is TK <!--payable_amount-->, Thanks, Polar Ice-cream',
				'is_designation_wise' => 0,
				'action' => 'problemEntryEdit_for_pull',
			],
			[
				'subject' => 'requisition_hold_SMS_for_executive',
				'message' => 'Dear Mr. <!--sender-->, your requisition has been hold for the <!--outlet_name-->. <!--comments-->. Thanks, <!--from-->',
				'is_designation_wise' => 0,
				'action' => 'requisition_hold',
			],
			[
				'subject' => 'requisition_cancel_SMS_for_executive',
				'message' => 'Dear Mr. <!--sender-->, your requisition has been cancelled for the <!--outlet_name-->. <!--comments-->. Thanks, <!--from-->',
				'is_designation_wise' => 0,
				'action' => 'requisition_cancel',
			],
			[
				'subject' => 'requisition_final_approved_SMS_for_shop_owner',
				'message' => 'Dear valuable customer <!--proprietor_name-->, Outlet: <!--outlet_name-->, your requisition for new DF has been approved. Our respective officer will communicate with you shortly. Thanks, Polar Ice-cream',
				'is_designation_wise' => 0,
				'action' => 'requisition_approve',
			],
			[
				'subject' => 'requisition_final_approved_SMS_for_executive',
				'message' => 'Dear Mr. <!--sender-->, your requisition for new DF has been approved for the <!--outlet_name-->. Take essential steps.',
				'is_designation_wise' => 0,
				'action' => 'requisition_approve',
			],
			[
				'subject' => 'bkash_payment_confirmation_SMS_shop_owner',
				'message' => 'Dear valuable customer <!--proprietor_name-->, Outlet: <!--outlet_name-->, we have received your payment of TK "<!--receive_amount-->" for DF service rent purpose. Thanks, Polar Ice-cream',
				'is_designation_wise' => 0,
				'action' => 'putTransactionId',
			],
			[
				'subject' => 'payable_confirmation_SMS_for_shop_owner',
				'message' => 'Dear valuable customer <!--proprietor_name-->, your settlement has been closed for the Outlet: <!--outlet_name-->, DF Code: <!--df_code--> and your receivable TK is "<!--paid_amount-->". Please collect your payment. Thanks, Polar Ice-cream',
				'is_designation_wise' => 0,
				'action' => 'payToOutlet',
			],
			[
				'subject' => 'payable_confirmation_SMS_for_executive',
				'message' => 'Dear Mr. <!--sender-->, settlement has been closed for the Outlet: <!--outlet_name-->, DF Code: <!--df_code--> and receivable TK is "<!--paid_amount-->". Take necessary steps. Thanks, Polar Ice-cream',
				'is_designation_wise' => 0,
				'action' => 'payToOutlet_executive',
			],

		]);
	}
}
