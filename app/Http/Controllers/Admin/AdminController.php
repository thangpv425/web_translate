<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meaning;
use App\Keyword;
use App\KeywordTemp;
use App\MeaningTemp;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminController extends Controller {
    /*
     * @todo show all words to admin
     * @return Illuminate\resource\views\admin\keyword_list
     */

    public function wordList() {
        $meaning = Meaning::all();
        return view('admin.keyWordList', ['meaning' => $meaning]);
    }

    public function addKeyword() {
        return view('admin.keywordAdd');
    }

    public function processAddKeyword(Request $request) {
        try {
            DB::beginTransaction();
            //create new keyword
            $keyword = new keyword();
            $keyword->keyword = $request->txtKeyWord;
            $keyword->status = APPROVED;
            $keyword->save();

            //create new meaning
            foreach ($request->translate as $key => $value) {
                $meaning = new meaning();
                $meaning->keyword_id = $keyword->id;
                $meaning->meaning = $value['meaning'];
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
     * @todo allow admin to solf delete word 
     */

    public function deleteWord($id) {
        try {
            DB::beginTransaction();
            $meaning = meaning::find($id);
            $meaning->status = 0;
            $meaning->save();
            $meaning->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        $meaning = Meaning::all();
        return view('admin.keyWordlist', ['meaning' => $meaning]);
    }

    public function checkExistKeyword(Request $request) {
        return keyword::where('keyword', $request->keyword)->count();
    }

    /**
     * return List request of keyword table
     * @return [type] [description]
     */
    public function keywordTempList() {
        $data = KeywordTemp::where('status', IN_QUEUE)->get();
        return view('admin.approve.keyword.list', ['data' => $data]);
    }

    /**
     * Approve request on keyword table
     * @param  [type] $id     [description]
     * @param  [type] $opCode [description]
     * @return [type]         [description]
     */
    public function approveChangesOnKeywordTable(Request $request) {
        if (!$request->has('opCode') || !$request->has('id')) {
            return redirect()->route('keywordTempList')->with('mess', 'Invalid Request!');
        }
        $keywordTemp = KeywordTemp::find($request->id);
        if ($keywordTemp == null) {
            return redirect()->route('keywordTempList')->with('mess', 'Request is not exist!');
        }
        // $keywordTemp != null
        $opCode = $request->opCode;
        if ($opCode == ADD) {
            $mess = AdminController::approveAddKeyword($keywordTemp);
        } elseif ($opCode == EDIT) {
            $mess = AdminController::approveEditKeyword($keywordTemp);
        } else {
            $mess = "Invalid Operation Code.";
        }
        return redirect()->route('keywordTempList')->with('mess', $mess);
    }

    /**
     * Approve adding new keyword 
     * @param  [type] $keywordTemp [description]
     * @return [type]              [description]
     */
    public function approveAddKeyword($keywordTemp) {
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
    public function approveEditKeyword($keywordTemp) {
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
    public function declineChangesOnKeywordTable(Request $request) {
        if (!$request->has('opCode') || !$request->has('id')) {
            return redirect()->route('keywordTempList')->with('mess', 'Invalid Request!');
        }
        $keywordTemp = KeywordTemp::find($request->id);
        if ($keywordTemp == null) {
            return redirect()->route('keywordTempList')->with('mess', 'Request is not exist!');
        }
        // $keywordTemp != null
        $opCode = $request->opCode;
        if ($opCode == ADD || $opCode == EDIT) {
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
            $mess = "Invalid Operation Code.";
        }
        return redirect()->route('keywordTempList')->with('mess', $mess);
    }

    /**
     * Delete a request
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteRequest(Request $request) {
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

}
