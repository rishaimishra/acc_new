<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\InvestigationController;
use App\Http\Controllers\CaseSummaryController;
use App\Http\Controllers\InvestigationPlanController;
use App\Http\Controllers\InterviewPlanController;
use App\Http\Controllers\IdiaryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\ArrestandDetentionController;
use App\Http\Controllers\SearchandSeizureController;
use App\Http\Controllers\FrozenAssetController;
use App\Http\Controllers\SuspensionController;
use App\Http\Controllers\Complaint\ComplaintController;
use App\Http\Controllers\Dzonkhag\DzonkhagController;
use App\Http\Controllers\Gewog\GewogController;
use App\Http\Controllers\Village\VillageController;
use App\Http\Controllers\Constituency\ConstituencyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Dashboard */
Route::get('dashboard/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

/* Case controller */

Route::get('director/assignedcases', [CaseController::class, 'directorassigned'])->name('directorassigned');
Route::get('director/nonassignedcases', [CaseController::class, 'directornonassigned'])->name('directornonassigned');
Route::get('/generateCaseno', [CaseController::class, 'generateCaseno'])->name('generateCaseno');
Route::get('/showdivisionheads', [CaseController::class,'showdivisionheads'])->name('showdivisionheads');
Route::post('/addcasefromcomplaint', [CaseController::class, 'addcasefromcomplaint'])->name('addcasefromcomplaint');
Route::post('/mergecase', [CaseController::class, 'mergecase'])->name('mergecase');
Route::get('/searchentity/{cid}', [CaseController::class, 'searchentity'])->name('searchentity');
Route::post('/registercase', [CaseController::class, 'registercase'])->name('registercase');
Route::get('/mycases', [CaseController::class, 'mycases'])->name('mycases');
Route::get('casefolder/showcasedetailsforcoi/{casenoid}', [CaseController::class, 'showcasedetailsforcoi'])->name('showcasedetailsforcoi');
Route::get('casefolder/showcasedetailsforreassigncasedirector/{casenoid}', [CaseController::class, 'showcasedetailsforreassigncasedirector'])->name('showcasedetailsforreassigncasedirector');

Route::get('casefolder/searchentitydetails/{id}', [CaseController::class, 'searchentitydetails'])->name('searchentitydetails');
Route::get('casefolder/showentitiesdtls/{id}', [CaseController::class, 'showentitydetails'])->name('showentitydetails');

Route::post('/declarecoichief', [CaseController::class, 'declarecoichief'])->name('declarecoichief');
Route::get('casefolder/viewcoi_chief/{casenoid}', [CaseController::class, 'viewcoi_chief'])->name('viewcoi_chief');
Route::post('/proceed_chief', [CaseController::class, 'proceed_chief'])->name('proceed_chief');
Route::post('/assigncasechief', [CaseController::class, 'assigncasechief'])->name('assigncasechief');
Route::get('casefolder/viewcoi/{casenoid}', [CaseController::class, 'viewcoi'])->name('viewcoi');
Route::get('casefolder/viewcoiinv/{casenoid}', [CaseController::class, 'viewcoiinv'])->name('viewcoiinv');
Route::post('/declarecoi_investigator', [CaseController::class, 'declarecoi_investigator'])->name('declarecoi_investigator');
Route::get('casefolder/viewcoitogether/{casenoid}', [CaseController::class, 'viewcoitogether'])->name('viewcoitogether');
Route::post('/printassignmentorder', [CaseController::class, 'printassignmentorder'])->name('printassignmentorder');
Route::post('/reassigncase', [CaseController::class, 'reassigncase'])->name('reassigncase');

Route::get('casefolder/showexistingteam/{casenoid}', [CaseController::class, 'showexistingteam'])->name('showexistingteam');

/* API COntroller */
Route::get('/gettoken', [APIController::class, 'gettoken'])->name('gettoken');

/* Person Controller */
Route::post('/savemainentity', [PersonController::class, 'savemainentity'])->name('savemainentity');
Route::post('/savecaseentity', [PersonController::class, 'savecaseentity'])->name('savecaseentity');

/* Investigation Controller */
Route::get('investigator/casesummary/{casenoid}', [InvestigationController::class, 'casesummary'])->name('casesummary');
Route::get('investigator/investigationplan/{casenoid}', [InvestigationController::class, 'viewinvestigationplan'])->name('viewinvestigationplan');
Route::get('investigator/interviewplan/{casenoid}', [InvestigationController::class, 'viewinterviewplan'])->name('viewinterviewplan');
Route::get('investigator/entity/{casenoid}', [InvestigationController::class, 'viewentity'])->name('viewentity');
Route::get('investigator/idiary/{casenoid}', [InvestigationController::class, 'viewidiary'])->name('viewidiary');
Route::get('investigator/caseevent/{casenoid}', [InvestigationController::class, 'viewcaseevent'])->name('viewcaseevent');
Route::get('investigator/evidence/{casenoid}', [InvestigationController::class, 'viewevidence'])->name('viewevidence');
Route::get('investigator/oands/{casenoid}', [InvestigationController::class, 'viewoands'])->name('viewoands');
Route::get('investigator/files/{casenoid}', [InvestigationController::class, 'viewfiles'])->name('viewfiles');
Route::get('investigator/reports/{casenoid}', [InvestigationController::class, 'viewreports'])->name('viewreports');
Route::get('investigator/linkanalysis/{casenoid}', [InvestigationController::class, 'viewlinkanalysis'])->name('viewlinkanalysis');

Route::get('investigator/plan/{casenoid}', [InvestigationController::class, 'viewplan'])->name('viewplan');
Route::get('investigator/hypothesisandevidence/{casenoid}', [InvestigationController::class, 'viewhypo'])->name('viewhypo');
Route::get('investigator/actionplan/{casenoid}', [InvestigationController::class, 'viewactionplan'])->name('viewactionplan');
Route::get('investigator/reviewplan/{casenoid}', [InvestigationController::class, 'viewreviewplan'])->name('viewreviewplan');

Route::get('investigator/summonorder/{casenoid}', [InvestigationController::class, 'viewsummonorder'])->name('viewsummonorder');
Route::get('investigator/interviewreport/{casenoid}', [InvestigationController::class, 'viewinterviewreport'])->name('viewinterviewreport');

Route::get('investigator/person/{casenoid}', [InvestigationController::class, 'viewperson'])->name('viewperson');
Route::get('investigator/organization/{casenoid}', [InvestigationController::class, 'vieworganization'])->name('vieworganization');
Route::get('investigator/asset/{casenoid}', [InvestigationController::class, 'viewasset'])->name('viewasset');

Route::get('investigator/arrest/{casenoid}', [InvestigationController::class, 'viewarrest'])->name('viewarrest');
Route::get('investigator/search/{casenoid}', [InvestigationController::class, 'viewsearch'])->name('viewsearch');
Route::get('investigator/seizure/{casenoid}', [InvestigationController::class, 'viewseizure'])->name('viewseizure');
Route::get('investigator/freeze/{casenoid}', [InvestigationController::class, 'viewfreeze'])->name('viewfreeze');
Route::get('investigator/suspension/{casenoid}', [InvestigationController::class, 'viewsuspension'])->name('viewsuspension');

Route::get('investigator/evidence/{casenoid}', [InvestigationController::class, 'viewevidence'])->name('viewevidence');
Route::get('investigator/evidencematrix/{casenoid}', [InvestigationController::class, 'viewevidencematrix'])->name('viewevidencematrix');

/* Case Summary Controller */

Route::post('/addcasesummary', [CaseSummaryController::class, 'addcasesummary'])->name('addcasesummary');
Route::post('/updatecasesummary', [CaseSummaryController::class, 'updatecasesummary'])->name('updatecasesummary');

/* Investigation Plan Controller */
Route::post('/add_investigation_plan', [InvestigationPlanController::class, 'add_investigation_plan'])->name('add_investigation_plan');
Route::post('/updateinvplan', [InvestigationPlanController::class, 'updateinvplan'])->name('updateinvplan');
Route::get('/editinvplan/{id}', [InvestigationPlanController::class, 'editinvplan'])->name('editinvplan');
Route::post('/add_hypothesis', [InvestigationPlanController::class, 'add_hypothesis'])->name('add_hypothesis');
Route::post('/add_action_plan', [InvestigationPlanController::class, 'add_action_plan'])->name('add_action_plan');
Route::post('/updateactionplanstatus', [InvestigationPlanController::class, 'updateactionplanstatus'])->name('updateactionplanstatus');

/* Interview Plan Controller */

Route::post('/add_interview_plan', [InterviewPlanController::class, 'add_interview_plan'])->name('add_interview_plan');
Route::post('/updateinterviewplan', [InterviewPlanController::class, 'updateinterviewplan'])->name('updateinterviewplan');
Route::get('/displayinterviewplandetails/{id}', [InterviewPlanController::class, 'displayinterviewplandetails'])->name('displayinterviewplandetails');
Route::get('/displaysummonorder/{id}', [InterviewPlanController::class, 'displaysummonorder'])->name('displaysummonorder');
Route::post('/printsummonorder', [InterviewPlanController::class, 'printsummonorder'])->name('printsummonorder');
Route::post('/addsummonorder', [InterviewPlanController::class, 'addsummonorder'])->name('addsummonorder');
Route::post('/displayinterviewreport', [InterviewPlanController::class, 'displayinterviewreport'])->name('displayinterviewreport');

/* iDiary Controller */
Route::post('/addidiary', [IdiaryController::class, 'addidiary'])->name('addidiary');
Route::get('/showeditidiary/{id}', [IdiaryController::class, 'showeditidiary'])->name('showeditidiary');
Route::post('/updateidiary', [IdiaryController::class, 'updateidiary'])->name('updateidiary');
Route::get('/deleteidiary/{idiary_id}', [IdiaryController::class, 'deleteidiary'])->name('deleteidiary');

/* Event Controller */

Route::post('/addevent', [EventController::class, 'addevent'])->name('addevent');
Route::get('/editevent/{caseno}', [EventController::class, 'editevent'])->name('editevent');
Route::post('/updateevent', [EventController::class, 'updateevent'])->name('updateevent');

/* Evidence Controller */

Route::post('/addevidences', [EvidenceController::class, 'addevidences'])->name('addevidences');
Route::get('/editevid/{caseno}', [EvidenceController::class, 'editevid'])->name('editevid');
Route::post('/updateevid', [EvidenceController::class, 'updateevid'])->name('updateevid');
Route::get('/generateevidenceno', [EvidenceController::class, 'generateevidenceno'])->name('generateevidenceno');

/* Arrest Controller */

Route::post('/addArrestdetails', [ArrestandDetentionController::class, 'addArrestdetails'])->name('addArrestdetails');
Route::get("arrestdetailsview/{arrest_id}",[ArrestandDetentionController::class,"arrestdetailsview"])->name("arrestdetailsview");
Route::get('commissionUpdateAnD/{arrest_id}',[ArrestandDetentionController::class,'commissionUpdateAnD'])->name('commissionUpdateAnD');
Route::post('/updateCommissionArrest',[ArrestandDetentionController::class,'updateCommissionArrest'])->name('updateCommissionArrest');
Route::get('detentionAdd/{arrest_id}',[ArrestandDetentionController::class,'detentionAdd'])->name('detentionAdd');
Route::post('/detentiondetailsadd',[ArrestandDetentionController::class,'detentiondetailsadd'])->name('detentiondetailsadd');
Route::get("detentiondetailsdisplay/{arrest_id}",[ArrestandDetentionController::class,"detentiondetailsdisplay"])->name("detentiondetailsdisplay");
Route::get("detentiondetailsdisplayforremand/{arrest_id}",[ArrestandDetentionController::class,"detentiondetailsdisplayforremand"])->name("detentiondetailsdisplayforremand");

/* Search and Seizure Controller */
Route::post('addsearch', [SearchandSeizureController::class, 'addsearch'])->name('addsearch');
Route::post('/saveGeneral',[SearchandSeizureController::class,'saveGeneral'])->name('saveGeneral');
Route::post('addsearchandseizuredetails',[SearchandSeizureController::class,'addsearchandseizuredetails'])->name('addsearchandseizuredetails');
Route::get('commissionUpdateSearch/{search_id}',[SearchandSeizureController::class,'commissionUpdateSearch'])->name('commissionUpdateSearch');
Route::post('/updateCommissionSearch',[SearchandSeizureController::class,'updateCommissionSearch'])->name('updateCommissionSearch');
Route::get('viewseizuredetails/{search_id}',[SearchandSeizureController::class,'viewseizuredetails'])->name('viewseizuredetails');
Route::get('viewsearchdetails/{search_id}',[SearchandSeizureController::class,'viewsearchdetails'])->name('viewsearchdetails');
Route::get('seizureAdd/{search_id}/{casenoid}',[SearchandSeizureController::class,'seizureAdd'])->name('seizureAdd');
Route::post('/updateSelectedRows',[SearchandSeizureController::class,'updateSelectedRows'])->name('updateSelectedRows');

//For Land
Route::get('NewAssetLand/{id}', [FrozenAssetController::class,'newAssetLand'])->name('newAssetLand');
Route::post('saveAssetLand',[FrozenAssetController::class,'saveAssetLand'])->name('saveAssetLand');
Route::get('NewAssetLandView/{aland_id}',[FrozenAssetController::class,'NewAssetLandView'])->name('NewAssetLandView');
Route::get('showlandasset/{casenoid}',[FrozenAssetController::class,'showlandasset'])->name('showlandasset');

//Building/House/Flat
Route::get('NewAssetBuilding/{id}', [FrozenAssetController::class,'newAssetBuilding'])->name('newAssetBuilding');
Route::post('saveAssetBuilding',[FrozenAssetController::class,'saveAssetBuilding'])->name('saveAssetBuilding');
Route::get('NewAssetBuildingView/{aBuilding_id}',[FrozenAssetController::class,'NewAssetBuildingView'])->name('NewAssetBuildingView');
Route::get('showbuildingasset/{casenoid}',[FrozenAssetController::class,'showbuildingasset'])->name('showbuildingasset');
//Vehicle/Equipment
Route::get('NewAssetVehicle/{id}', [FrozenAssetController::class,'newAssetVehicle'])->name('newAssetVehicle');
Route::post('saveAssetVehicle',[FrozenAssetController::class,'saveAssetVehicle'])->name('saveAssetVehicle');
Route::get('NewAssetVehicleView/{avehicle_id}',[FrozenAssetController::class,'NewAssetVehicleView'])->name('NewAssetVehicleView');
Route::get('showvehicleasset/{casenoid}',[FrozenAssetController::class,'showvehicleasset'])->name('showvehicleasset');
//Bank Account
Route::get('NewAssetBankAccount/{id}', [FrozenAssetController::class,'newAssetBankAccount'])->name('newAssetBankAccount');
Route::post('saveAssetBank',[FrozenAssetController::class,'saveAssetBank'])->name('saveAssetBank');
Route::get('NewAssetBankAccountView/{abank_id}',[FrozenAssetController::class,'NewAssetBankAccountView'])->name('NewAssetBankAccountView');
Route::get('showbankasset/{casenoid}',[FrozenAssetController::class,'showbankasset'])->name('showbankasset');
//Securities
Route::get('NewAssetSecurities/{id}', [FrozenAssetController::class,'newAssetSecurities'])->name('newAssetSecurities');
Route::post('saveAssetSecurities',[FrozenAssetController::class,'saveAssetSecurities'])->name('saveAssetSecurities');
Route::get('NewAssetSecuritiesView/{aSecurities_id}',[FrozenAssetController::class,'NewAssetSecuritiesView'])->name('NewAssetSecuritiesView');
//*****----- End Frozen Assets -----*****

/* Suspension Controller */

Route::post('/addsuspension', [SuspensionController::class, 'addsuspension'])->name('addsuspension');
Route::get('/generatesuspensionorder/{id}/{casenoid}', [SuspensionController::class, 'generatesuspensionorder'])->name('generatesuspensionorder');
Route::get('/revokesuspensionorder/{id}/{casenoid}', [SuspensionController::class, 'revokesuspensionorder'])->name('revokesuspensionorder');



// complaint-register-module
Route::get('manage-complaint-attachment/{id}',[ComplaintController::class,'attachmentView'])->name('attachment.view.complaint');
Route::post('manage-complaint-attachment/post-complaint',[ComplaintController::class,'attachmentPost'])->name('attachment.post.complaint');
Route::get('manage-complaint-attachment/delete-attachment/{id}',[ComplaintController::class,'attachmentDelete'])->name('attachment.delete.complaint');

// case-link
Route::get('manage-complaint-link-case/{id}',[ComplaintController::class,'linkCaseView'])->name('link.case.complaint');

Route::post('manage-complaint-link-case/registerLink',[ComplaintController::class,'registerLink'])->name('link.case.complaint.register');

Route::get('manage-complaint-link-case/delete/{id}',[ComplaintController::class,'deleteLink'])->name('link.case.complaint.delete');

Route::get('manage-complaint-link-case/link-person-case/{complaint_id}/{id}',[ComplaintController::class,'linkPersonCase'])->name('link.case.complaint.person.case');

// search-case
Route::post('autocomplete-search-case',[ComplaintController::class,'searchCasesAutoComplete'])->name('search.autocomplete.cases');

// person-involved
Route::get('manage-complaint-person-involved/{id}',[ComplaintController::class,'personInvolvedView'])->name('person.involved.complaint');
Route::get('manage-complaint-person-involved/delete-person/{id}/{complaint_id}',[ComplaintController::class,'personInvolvedDelete'])->name('person.involved.complaint.delete.person');
Route::post('manage-complaint-person-involved/ajax-person-bhutanese-details',[ComplaintController::class,'bhutaneseDetails'])->name('person.involved.bhutanese.details');

Route::post('manage-complaint-person-involved/ajax-person-non-bhutanese-details',[ComplaintController::class,'noNbhutaneseDetails'])->name('person.involved.non.bhutanese.details');

Route::post('manage-complaint-person-involved/post-person-involved',[ComplaintController::class,'postPersonInvolved'])->name('postPersonInvolved.person.involved');

// complaint-registration
Route::get('manage-complaint-registration-add',[ComplaintController::class,'complaintRegView'])->name('complaint.registration.add.view');
Route::get('fetchConstituency',[ComplaintController::class,'fetchConstituency'])->name('get.fetchConstituency');
Route::get('fetchAgency',[ComplaintController::class,'fetchAgency'])->name('get.fetchAgency');
Route::get('departmentFetch',[ComplaintController::class,'departmentFetch'])->name('get.departmentFetch');

Route::post('SaveComplaintRegistration',[ComplaintController::class,'SaveComplaintRegistration'])->name('SaveComplaintRegistration');
// dependency-dropdown
Route::get('get-gewog-onchange-dzongkhag',[ComplaintController::class,'getGewog'])->name('get.gewog.onchange.dzongkhag');
Route::get('get-village-onchange-gewog',[ComplaintController::class,'getVillage'])->name('get.village.onchange.gewog');

// Dzonkhag crud
Route::resource('dzonkhag', DzonkhagController::class);
Route::resource('gewog', GewogController::class);
Route::resource('village', VillageController::class);
Route::resource('constituency', ConstituencyController::class);

Route::get('dzonkhags/{id}',[DzonkhagController::class,'deleteDz'])->name('dzonkhag.delete');
Route::get('gewogs/{id}',[GewogController::class,'deleteGz'])->name('gewog.delete');
Route::get('villages/{id}',[VillageController::class,'deleteVj'])->name('village.delete');
Route::get('constituencys/{id}',[ConstituencyController::class,'deleteConsti'])->name('consti.delete');
