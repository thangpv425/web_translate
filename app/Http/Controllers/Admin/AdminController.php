<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meaning;
use App\Keyword;
use App\KeywordTemp;
use App\MeaningTemp;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /*
    * @todo show all words to admin
    * @return Illuminate\resource\views\admin\keyword_list
    */
    public function wordList(){   	    	
        $meaning=Meaning::all();
        return view('admin.keyWordList',['meaning'=>$meaning]);
    }
    
    public function getKeywordAdd(){
        return view('admin.keywordAdd');
    }
    
    public function postKeywordAdd(Request $request){
        try {
            DB::beginTransaction();
            //create new keyword
            $keyword = new keyword();
            $keyword->value = $request->txtKeyWord;
            $keyword->status= APPROVED;
            $keyword->save();
            
            //create new meaning
            foreach ( $request->translate as $key => $value ) {
                $meaning = new meaning();
                $meaning->keyword_id = $keyword->keyword_id;
                $meaning->value = $value['meaning'];
                $meaning->index = $key;
                $meaning->status = APPROVED;
                $meaning->language = $value['language'];
                $meaning->save();
            }
            $notification = 'You have successfully add new keyword.';
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $notification = 'Something went wrong!';
        }
        return redirect('admin/keywordList')->with('notification', $notification);
    }
    
    /*
    *@todo allow admin to solf delete word 
    */
    public function deleteWord($id){
    	try {
            DB::beginTransaction();
            $meaning= meaning::where($id)->first();
            $meaning->status= DELETED;
            $meaning->save();
            DB::commit();
    	} catch (\Exception $e) {
    		DB::rollback();
    	}
    	$meaning= meaning::all();
    	return view('admin.keyWordlist',['meaning'=>$meaning]);
    }

    public function checkExistKeyword(Request $request)
    {
        return keyword::where('value', $request->keyword)->count();
    }

    /**
     * return List request of keyword table
     * @return [type] [description]
     */
    public function keywordTempList()
    {
        $data = KeywordTemp::where('status', IN_QUEUE)->get();
        return view('admin.approve.keyword.list', ['data' => $data]);
    }

    /**
     * Approve request on keyword table
     * @param  [type] $id     [description]
     * @param  [type] $opCode [description]
     * @return [type]         [description]
     */
    public function approveChangesOnKeywordTable(Request $request)
    {
        $mess = "Request is not exist!";
        $keywordTemp = KeywordTemp::find($request->id);
        $opCode = $request->opCode;
        if (!$request->has('id') || !$request->has('opCode') || ($request->opCode != ADD && $request->opCode != EDIT)) {
            $mess = "Invalid Request!";
        }
        if (isset($opCode) && $opCode == ADD && $keywordTemp != null) {
            $mess = AdminController::approveAddKeyword($keywordTemp);
        }
        if ($opCode == EDIT && $keywordTemp != null){
            $mess = AdminController::approveEditKeyword($keywordTemp);
        }
        return redirect()->route('keywordTempList')->with('mess', $mess);
    }

    /**
     * Approve adding new keyword 
     * @param  [type] $keywordTemp [description]
     * @return [type]              [description]
     */
    public function approveAddKeyword($keywordTemp)
    {
        $mess = "";
        try {
            DB::beginTransaction();
            $keyword = Keyword::find($keywordTemp->old_keyword_id);
            $keyword->status = APPROVED;
            $keyword->save();
            $keywordTemp->status = APPROVED;
            $keywordTemp->save();
            DB::commit();
            $mess = "Successful!";
        } catch (\Exception $e) {
            DB::rollback();
            $mess = "Something wrong.";
        }
        return $mess;
    }

    /**
     * Approve editing keyword
     * @param  [type] $keywordTemp [description]
     * @return [type]              [description]
     */
    public function approveEditKeyword($keywordTemp)
    {
        $mess = "";
        try {
            DB::beginTransaction();
            $keyword = Keyword::find($keywordTemp['old_keyword_id']);
            $keyword->keyword = $keywordTemp['new_keyword'];
            $keyword->save();
            $keywordTemp->status = APPROVED;
            $keywordTemp->save();
            DB::commit();
            $mess = "Successful!";
        } catch (\Exception $e) {
            DB::rollback();
            $mess = "Something wrong!";
        }
        return $mess;
    }
    /**
     * Decline request on keyword table
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function declineChangesOnKeywordTable(Request $request)
    {   
        if ($request->has('id')) {
            $keywordTemp = KeywordTemp::find($request->id);
            try {
                DB::beginTransaction();
                $keywordTemp->status = DECLINED;
                $keywordTemp->comment = $request->get('cmt');
                $keywordTemp->save();
                DB::commit();
                $mess = "User's Request Declined!";
            } catch (\Exception $e) {
                DB::rollback();
                $mess = "Something wrong!";
            }
        } else {
            $mess = "Request is not exist!";
        }
        return redirect()->route('keywordTempList')->with('mess', $mess);
    }

    /**
     * Delete a request
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteRequest(Request $request)
    {
        $mess = "";
        try {
            DB::beginTransaction();
            $keywordTemp = KeywordTemp::find($request->id);
            $keywordTemp->status = DELETED;
            $keywordTemp->save();
            DB::commit();
            $mess = "Request Deleted!";
        } catch (\Exception $e) {
            DB::rollback();
            $mess = "Something wrong!";
        }
        return redirect()->route('keywordTempList')->with('mess', $mess);
    }
    

    /**
     * return list request on meaning table
     * @return [type] [description]
     */
    public function meaningTempList()
    {
        $data = MeaningTemp::where('status', IN_QUEUE)->get();
        return view('admin.approve.meaning.list', ['data' => $data]);
    }

    /**
     * Approve changes on meaning table
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function approveChangesOnMeaningTable(Request $request)
    {
        $mess = "Request is not exist!";
        $opCode = $request->opCode;
        $meaningTemp = MeaningTemp::find($request->id);
        if (!$request->has('opCode') || !$request->has('id') || ($opCode != ADD && $opCode != EDIT)) {
            $mess = "Invalid Request!";
        }
        if (isset($opCode) && $opCode == ADD && $meaningTemp != null) {
            $mess = AdminController::approveAddMeaning($meaningTemp);
        }
        if ($opCode == EDIT && $meaningTemp != null){
            $mess = AdminController::approveEditMeaning($meaningTemp);
        }
        return redirect()->route('meaningTempList')->with('mess', $mess);
    }

    public function approveAddMeaning($meaningTemp)
    {
        $mess = "";
        try {
            DB::beginTransaction();
            $meaning = new Meaning;
            $meaning->meaning = $meaningTemp['new_meaning'];
            $meaning->language = $meaningTemp['language'];
            $meaning->index = $meaningTemp['index'];
            $meaning->keyword_id = $meaningTemp['keyword_id'];
            $meaning->status = APPROVED;
            $meaning->save();
            $meaningTemp->status = APPROVED;
            $meaningTemp->save();
            DB::commit();
            $mess = "Successful!";
        } catch (\Exception $e) {
            DB::rollback();
            $mess = "Something wrong!";
        }
        return $mess;
    }

    public function approveEditMeaning($meaningTemp)
    {
        try {
            DB::beginTransaction();
            $meaning = Meaning::find($meaningTemp['old_meaning_id']);
            $meaning->meaning = $meaningTemp['new_meaning'];
            $meaning->save();
            $meaningTemp->status = APPROVED;
            $meaningTemp->save();
            DB::commit();
            $mess = "Successful!";
        } catch (\Exception $e) {
            DB::rollback();
            $mess = "Something wrong!";
        }
        return $mess;
    }

    /**
     * Decline changes on meaning table
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function declineChangesOnMeaningTable(Request $request)
    {
        if (!$request->has('id')) {
            $mess = "Invalid Request!";
        }
        $meaningTemp = MeaningTemp::find($request->id);
        if($meaningTemp != null){
            try {
                DB::beginTransaction();
                $meaningTemp->status = DECLINED;
                $meaningTemp->comment = $request->get('cmt');
                $meaningTemp->save();
                DB::commit();
                $mess = "Successful!";
            } catch (\Exception $e) {
                DB::rollback();
                $mess = "Something wrong!";
            }
        }else{
            $mess = "Request is not exist!";
        }
        return redirect()->route('meaningTempList')->with('mess', $mess);
    }

    public function deleteRequestOnMeaningTable(Request $request)
    {
        $mess = "";
        try {
            DB::beginTransaction();
            $meaningTemp = MeaningTemp::find($request->id);
            $meaningTemp->status = DELETED;
            $meaningTemp->save();
            DB::commit();
            $mess = "Request Deleted!";
        } catch (\Exception $e) {
            DB::rollback();
            $mess = "Something wrong!";
        }
        return redirect()->route('meaningTempList')->with('mess', $mess);
    }

}