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
use App\Http\Controllers\Embasy\EmbasyController;
use App\Http\Controllers\ComplaintMaster\ComplaintMasterController;
use App\Http\Controllers\ComplaintMaster\ComplaintType;
use App\Http\Controllers\ComplaintMaster\SourceController;
use App\Http\Controllers\ComplaintMaster\PersonCategory;
use App\Http\Controllers\AssignComplaint\AssignComplaintController;
use App\Http\Controllers\EmpCat\EmpCatController;
use App\Http\Controllers\agency\AgencyController;
use App\Http\Controllers\Corrupt\CorruptionController;
use App\Http\Controllers\CorruptArea\CorruptionAreaController;
use App\Http\Controllers\ComplainEvaDecision\ComplainEvalDecController;
use App\Http\Controllers\PlvalueRange\PlValueRangeController;
use App\Http\Controllers\InterPretationPValue\InterPretationPValuesController;


use App\Http\Controllers\AssignComplaintRegional;
use App\Http\Controllers\Evaluation\EvaluationController;
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

Route::get('complaint-register',[ComplaintController::class,'list'])->name('complaint-register.list');
Route::get('manage-complaint-registration-edit/{id}',[ComplaintController::class,'complaintRegEdit'])->name('complaint.registration.edit.view');
Route::get('complaint-register',[ComplaintController::class,'list'])->name('complaint-register.list');
Route::get('manage-complaint-registration-edit/{id}',[ComplaintController::class,'complaintRegEdit'])->name('complaint.registration.edit.view');


Route::post('manage-complaint-registration-edit/update-complaint',[ComplaintController::class,'updateComplaint'])->name('complaint.registration.edit.update');

Route::post('manage-complaint-registration-edit/update-complaint',[ComplaintController::class,'updateComplaint'])->name('complaint.registration.edit.update');

Route::post('SaveComplaintRegistration',[ComplaintController::class,'SaveComplaintRegistration'])->name('SaveComplaintRegistration');


// Route::get('complaint-register',[ComplaintController::class,'list'])->name('complaint-register.list');
// Route::get('manage-complaint-registration-edit/{id}',[ComplaintController::class,'complaintRegEdit'])->name('complaint.registration.edit.view');
// Route::post('manage-complaint-registration-edit/update-complaint',[ComplaintController::class,'updateComplaint'])->name('complaint.registration.edit.update');



Route::get('complaint-register',[ComplaintController::class,'list'])->name('complaint-register.list');
Route::get('manage-complaint-registration-edit/{id}',[ComplaintController::class,'complaintRegEdit'])->name('complaint.registration.edit.view');
Route::post('manage-complaint-registration-edit/update-complaint',[ComplaintController::class,'updateComplaint'])->name('complaint.registration.edit.update');
// dependency-dropdown
Route::get('get-gewog-onchange-dzongkhag',[ComplaintController::class,'getGewog'])->name('get.gewog.onchange.dzongkhag');
Route::get('get-village-onchange-gewog',[ComplaintController::class,'getVillage'])->name('get.village.onchange.gewog');

// Dzonkhag crud
Route::resource('dzonkhag', DzonkhagController::class);
Route::resource('gewog', GewogController::class);
Route::resource('village', VillageController::class);
Route::resource('constituency', ConstituencyController::class);
Route::resource('embassy', EmbasyController::class);
Route::resource('emp-category', EmpCatController::class);
Route::resource('agency', AgencyController::class);
Route::resource('corruption-type', CorruptionController::class);
Route::resource('corruption-area', CorruptionAreaController::class);
Route::resource('complain-evaluation-decision', ComplainEvalDecController::class);
Route::resource('pl-value-range', PlValueRangeController::class);
Route::resource('pl-value-scope', InterPretationPValuesController::class);


Route::get('dzonkhags/{id}',[DzonkhagController::class,'deleteDz'])->name('dzonkhag.delete');
Route::post('dzonkhags-edit',[DzonkhagController::class,'EditDz'])->name('dzonkhag.edit');
Route::get('gewogs/{id}',[GewogController::class,'deleteGz'])->name('gewog.delete');
Route::get('villages/{id}',[VillageController::class,'deleteVj'])->name('village.delete');
Route::get('constituencys/{id}',[ConstituencyController::class,'deleteConsti'])->name('consti.delete');
Route::get('embassys/{id}',[EmbasyController::class,'deleteEmbassy'])->name('embasy.delete');
Route::get('employee-cat/{id}',[EmpCatController::class,'deleteEmpCat'])->name('emp.category.delete');
Route::get('agencys/{id}',[AgencyController::class,'deleteAgency'])->name('agency.delete');
Route::get('corruption-types/{id}',[CorruptionController::class,'deleteCoruptype'])->name('corruptype.delete');
Route::get('corruption-areas/{id}',[CorruptionAreaController::class,'deleteCoruptArea'])->name('corruparea.delete');
Route::get('complain-evaluation-decisions/{id}',[ComplainEvalDecController::class,'deleteCompEvalDec'])->name('complaint-evaluation-decision.delete');
Route::get('pl-values-ranges/{id}',[PlValueRangeController::class,'deleteValueRange'])->name('value.rangepl.delete');
Route::get('pl-values-scope/{id}',[InterPretationPValuesController::class,'deleteValueScope'])->name('value.scope.delete');


// complaint-masters
Route::get('complaint-mode',[ComplaintMasterController::class,'list'])->name('complaint-mode-master');
Route::post('complaint-mode/add',[ComplaintMasterController::class,'add'])->name('complaint-mode-master.add');
Route::post('complaint-mode/update',[ComplaintMasterController::class,'add'])->name('complaint-mode-master.update');
Route::get('complaint-mode/delete/{id}',[ComplaintMasterController::class,'delete'])->name('complaint-mode-master.delete');

// complaint-type
Route::get('complaint-type',[ComplaintType::class,'list'])->name('complaint-type-master');
Route::post('complaint-type/add',[ComplaintType::class,'add'])->name('complaint-type-master.add');
Route::get('complaint-type/delete/{id}',[ComplaintType::class,'delete'])->name('complaint-type-master.delete');
Route::post('complaint-type/update',[ComplaintType::class,'update'])->name('complaint-type-master.update');
// source
Route::get('source-complaint',[SourceController::class,'list'])->name('source-complaint-master');
Route::post('source-complaint/add',[SourceController::class,'add'])->name('source-complaint-master.add');
Route::get('source-complaint/delete/{id}',[SourceController::class,'delete'])->name('source-complaint-master.delete');
Route::post('source-complaint/update',[SourceController::class,'update'])->name('source-complaint-master.update');
// person-category
Route::get('person-category',[PersonCategory::class,'list'])->name('person-category-master');
Route::post('person-category/add',[PersonCategory::class,'add'])->name('person-category-master.add');
Route::get('person-category/delete/{id}',[PersonCategory::class,'delete'])->name('person-category-master.delete');
Route::post('person-category/update',[PersonCategory::class,'update'])->name('person-category-master.update');


// followup-status
Route::get('followup-status',[App\Http\Controllers\Pursuability\FollowUpController::class,'list'])->name('followup-status-master');
Route::post('followup-status/add',[App\Http\Controllers\Pursuability\FollowUpController::class,'add'])->name('followup-status-master.add');
Route::get('followup-status/delete/{id}',[App\Http\Controllers\Pursuability\FollowUpController::class,'delete'])->name('followup-status-master.delete');
Route::post('followup-status/update',[App\Http\Controllers\Pursuability\FollowUpController::class,'update'])->name('followup-status-master.update');

// assign-complaint
Route::get('assign-complaint',[AssignComplaintController::class,'list'])->name('assign.complaint');
Route::get('complaint-view-details/{id}',[AssignComplaintController::class,'viewDetails'])->name('complaint.view.details');
Route::post('assign-complaint-post',[AssignComplaintController::class,'postAssign'])->name('assign.complaint.post');
Route::post('assign-complaint-post-update',[AssignComplaintController::class,'postAssignUpdate'])->name('assign.complaint.post.update');






Route::get('complaint-view-details/attachment-details/{id}',[AssignComplaintController::class,'viewDetailsAttachment'])->name('complaint.view.details.attachment.details');

Route::get('complaint-view-details/person-involved-details/{id}',[AssignComplaintController::class,'viewDetailsPersonInvolved'])->name('complaint.view.details.aperson-involved-details');

Route::get('complaint-view-details/case-link-details/{id}',[AssignComplaintController::class,'viewDetailsCaseLink'])->name('complaint.view.details.case-link-details');


// assign-complaint-regional
Route::get('assign-complaint-regional',[AssignComplaintRegional::class,'list'])->name('assign.complaint.regional');
Route::get('complaint-view-details-regional/{id}',[AssignComplaintRegional::class,'viewDetails'])->name('complaint.view.details.regional');
Route::post('assign-complaint-post-regional',[AssignComplaintRegional::class,'postAssign'])->name('assign.complaint.post.regional');
Route::post('assign-complaint-post-update-regional',[AssignComplaintRegional::class,'postAssignUpdate'])->name('assign.complaint.post.update.regional');


Route::get('complaint-view-details-regional/attachment-details/{id}',[AssignComplaintRegional::class,'viewDetailsAttachment'])->name('complaint.view.details.attachment.details.regional');

Route::get('complaint-view-details-regional/person-involved-details/{id}',[AssignComplaintRegional::class,'viewDetailsPersonInvolved'])->name('complaint.view.details.aperson-involved-details.regional');

Route::get('complaint-view-details-regional/case-link-details/{id}',[AssignComplaintRegional::class,'viewDetailsCaseLink'])->name('complaint.view.details.case-link-details.regional');

Route::post('embassys-edit',[EmbasyController::class,'EditEmbassy'])->name('embasy.edit');


// complaint-evaluation
Route::get('complaint-evaluation-list',[EvaluationController::class,'index'])->name('complaint.evaluate.list');
Route::get('complaint-evaluation-list/coi/{id}',[EvaluationController::class,'coi'])->name('complaint.conflict.interest');
Route::post('complaint-coi-post-decision',[EvaluationController::class,'postDecision'])->name('complaint.evaluate.conflict.decision');

// ce_pltblpvaluecategory
Route::get('pursuability-value-category',[App\Http\Controllers\Pursuability\CategoryController::class,'index'])->name('manage.pursuability-value-category');

Route::post('pursuability-value-category/insert',[App\Http\Controllers\Pursuability\CategoryController::class,'insert'])->name('manage.pursuability-value-category.insert');
Route::post('pursuability-value-category/update',[App\Http\Controllers\Pursuability\CategoryController::class,'update'])->name('manage.pursuability-value-category.update');

Route::get('pursuability-value-category/delete/{id}',[App\Http\Controllers\Pursuability\CategoryController::class,'delete'])->name('manage.pursuability-value-category.delete');


// ce_pltblpvaluecategory-sub-category
Route::get('pursuability-value-sub-category',[App\Http\Controllers\Pursuability\SubCategoryController::class,'index'])->name('manage.pursuability-value-sub-category');

Route::post('pursuability-value-sub-category/insert',[App\Http\Controllers\Pursuability\SubCategoryController::class,'insert'])->name('manage.pursuability-value-sub-category.insert');
Route::post('pursuability-value-sub-category/update',[App\Http\Controllers\Pursuability\SubCategoryController::class,'update'])->name('manage.pursuability-value-sub-category.update');

Route::get('pursuability-value-sub-category/delete/{id}',[App\Http\Controllers\Pursuability\SubCategoryController::class,'delete'])->name('manage.pursuability-value-sub-category.delete');

// ce_pltblvalue-fields


Route::get('pursuability-value-feilds',[App\Http\Controllers\Pursuability\ValueFields::class,'index'])->name('manage.pursuability-value-feilds');

Route::post('pursuability-value-feilds/insert',[App\Http\Controllers\Pursuability\ValueFields::class,'insert'])->name('manage.pursuability-value-feilds.insert');
Route::post('pursuability-value-feilds/update',[App\Http\Controllers\Pursuability\ValueFields::class,'update'])->name('manage.pursuability-value-feilds.update');

Route::get('pursuability-value-feilds/delete/{id}',[App\Http\Controllers\Pursuability\ValueFields::class,'delete'])->name('manage.pursuability-value-feilds.delete');


// masters-landing-page
Route::get('masters-landing-page',[App\Http\Controllers\Pursuability\ValueFields::class,'masters'])->name('masters.landing.page');






Route::post('embassys-edit',[EmbasyController::class,'EditEmbassy'])->name('embasy.edit');
Route::post('empcategory-edit',[EmpCatController::class,'EditEmpCat'])->name('emp.cat.edit');
Route::post('gewog-edit',[GewogController::class,'EditGewog'])->name('gewog.edit.update');
Route::post('village-edit',[VillageController::class,'EditVillage'])->name('village.edit.update');
Route::get('gewog-list-per-dzonkhag/{id}',[VillageController::class,'gewoglistAsperDzongkhag'])->name('gewog.list.dz');
Route::post('constituency-edit',[ConstituencyController::class,'EditConstituency'])->name('constituency.edit.update');
Route::post('agency-edit',[AgencyController::class,'EditAgency'])->name('agency.edit.update');
Route::post('corrupt-type-edit',[CorruptionController::class,'EditCorruptype'])->name('corruptype.edit.update');
Route::post('corrupt-area-edit',[CorruptionAreaController::class,'EditCorruparea'])->name('corruparea.edit.update');
Route::post('complain-eval-decision-edit',[ComplainEvalDecController::class,'EditCorruparea'])->name('compevaldec.edit.update');
Route::post('pl-value-range-edit',[PlValueRangeController::class,'EditPlValues'])->name('plvalues.edit.update');
Route::post('pl-value-scope-edit',[InterPretationPValuesController::class,'EditPlValuesScore'])->name('plvaluesScore.edit.update');


// new-
// evaluation-masters//////////////////////////////////
Route::get('investigation-branch',[App\Http\Controllers\InvestigationMaster\BranchController::class,'index'])->name('manage.investigation-branch');

Route::post('investigation-branch/insert',[App\Http\Controllers\InvestigationMaster\BranchController::class,'insert'])->name('manage.investigation-branch.insert');
Route::post('investigation-branch/update',[App\Http\Controllers\InvestigationMaster\BranchController::class,'update'])->name('manage.investigation-branch.update');

Route::get('investigation-branch/delete/{id}',[App\Http\Controllers\InvestigationMaster\BranchController::class,'delete'])->name('manage.investigation-branch.delete');


Route::get('case-priority',[App\Http\Controllers\InvestigationMaster\CasePriority::class,'index'])->name('manage.case-priority');

Route::post('case-priority/insert',[App\Http\Controllers\InvestigationMaster\CasePriority::class,'insert'])->name('manage.case-priority.insert');
Route::post('case-priority/update',[App\Http\Controllers\InvestigationMaster\CasePriority::class,'update'])->name('manage.case-priority.update');

Route::get('case-priority/delete/{id}',[App\Http\Controllers\InvestigationMaster\CasePriority::class,'delete'])->name('manage.case-priority.delete');



Route::get('investigation-type',[App\Http\Controllers\InvestigationMaster\InvestigationType::class,'index'])->name('manage.investigation-type');

Route::post('investigation-type/insert',[App\Http\Controllers\InvestigationMaster\InvestigationType::class,'insert'])->name('manage.investigation-type.insert');
Route::post('investigation-type/update',[App\Http\Controllers\InvestigationMaster\InvestigationType::class,'update'])->name('manage.investigation-type.update');

Route::get('investigation-type/delete/{id}',[App\Http\Controllers\InvestigationMaster\InvestigationType::class,'delete'])->name('manage.investigation-type.delete');


Route::get('task-masters',[App\Http\Controllers\InvestigationMaster\Task::class,'index'])->name('manage.task-masters');

Route::post('task-masters/insert',[App\Http\Controllers\InvestigationMaster\Task::class,'insert'])->name('manage.task-masters.insert');
Route::post('task-masters/update',[App\Http\Controllers\InvestigationMaster\Task::class,'update'])->name('manage.task-masters.update');

Route::get('task-masters/delete/{id}',[App\Http\Controllers\InvestigationMaster\Task::class,'delete'])->name('manage.task-masters.delete');