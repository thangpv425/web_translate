<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Meaning;
use App\Keyword;
use App\KeywordTemp;
use App\MeaningTemp;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddKeywordRequest;

class AdminController extends Controller {
    /*
     * @todo show all words to admin
     * @return Illuminate\resource\views\admin\keyword_list
     */

    public function meaningList() {
        $meaning = Meaning::all();
        return view('admin.meaning-list', ['meaning' => $meaning]);
    }

    public function keywordList()
    {
        echo "string";
    }

    public function addKeyword() {
        return view('admin.keywordAdd');
    }

    public function processAddKeyword(AddKeywordRequest $request) {
        try {
            $dataMeaning = array();
            DB::beginTransaction();
            $keyword = Keyword::create([
                'keyword' => $request->keyword,
                'status' => APPROVED
            ]);
            foreach ($request->translate as $key => $value) {
                $dataMeaning[] = array(
                    'keyword_id' => $keyword->id,
                    'meaning' => $value['meaning'],
                    'index' => $key,
                    'status' => APPROVED,
                    'language' => $value['language'],
                    'type' => $value['type'],
                );
            }
            foreach ($dataMeaning as $key => $value) {
                $meaning = Meaning::create($value);
            }
            DB::commit();
            $notification = array(
                'message' => 'You have been added new keyword successfully.',
                'alert-type' => 'success',
            );
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'error',
            );
            return redirect('admin/add/keyword')->with($notification);
        }
        return redirect('admin/meaning/list')->with($notification);
    }

    /*
     * @todo allow admin to solf delete word 
     */

    public function deleteWord($id) {
        try {
            $meaning = Meaning::find($id);
            $keyword = Keyword::find($meaning->keyword_id);

            DB::beginTransaction();
            $meaning->delete();
            //delete keyword if there are not any meaning
            $numberOfMeanings = Meaning::where('keyword_id', $meaning->keyword_id)->count();
            if ($numberOfMeanings == 0) {
                $keyword->delete();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('admin/meaning/list');
    }

    public function editKeyword($id) {

        $keyword = Keyword::find($id);
        $meaning = $keyword->meaning;
        $numberOfMeanings = Meaning::where('keyword_id', $id)->count();
        return view('admin.keywordEdit', [
            'keyword' => $keyword,
            'meaning' => $meaning,
            'numberOfMeanings' => $numberOfMeanings
        ]);
    }

    public function processEditKeyword(\App\Http\Requests\EditWordRequestRequest $request) {
        $id = $request->keyword_id;
        try {
            foreach ($request->translate as $key => $value) {
                $dataMeaning[] = array(
                    'meaning_id' => $value['meaning_id'],
                    'meaning' => $value['meaning'],
                    'language' => $value['language'],
                );
            }

            DB::beginTransaction();            
            Keyword::find($id)->update(['keyword'=>$request->keyword]);
            foreach ($dataMeaning as $key => $value) {
                Meaning::where('id', $value['meaning_id'])
                    ->update([
                        'meaning' => $value['meaning'],
                        'language' => $value['language']
                    ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('admin/meaning/list');
    }

    /**
     * return List request of keyword table
     * @return [type] [description]
     */

    public function postDataForKeywordTemp(Request $request)
    {
        $list = IN_QUEUE;
        if ($request->has('list')) {
            $list = $request->list;
        }
        $result = KeywordTemp::where('status', $list)->get();
        $data = array();
        foreach ($result as $key => $value) {
            $sub = array(
                $value['id'], 
                $value['opCode'], 
                $value->user->email, 
                $value->keyword['keyword'], 
                $value->new_keyword, 
                $value['comment']
            );
            $data[] = $sub;
        }
        $output = array(
            'data' => $data,
            'info' => 'my info'
        );
        return response()->json($output);
    }

    public function indexKeywordTemp()
    {
        return view('admin.approve.keyword.list');
    }

    /**
     * Approve request on keyword table
     * @param  [type] $id     [description]
     * @param  [type] $opCode [description]
     * @return [type]         [description]
     */
    public function approveChangesOnKeywordTable(Request $request) {
        $notification = array(
            'message' => 'Request is not exist.',
            'alert-type' => 'error'
        );
        $keywordTemp = KeywordTemp::find($request->id);
        $opCode = $request->opCode;
        if (!$request->has('id') || !$request->has('opCode') || ($request->opCode != ADD && $request->opCode != EDIT)) {
            $notification = array(
                'message' => 'Invalid request.',
                'alert-type' => 'error'
            );
        }
        if (isset($opCode) && $opCode == ADD && $keywordTemp != null) {
            $notification = AdminController::approveAddKeyword($keywordTemp);
        }
        if ($opCode == EDIT && $keywordTemp != null) {
            $notification = AdminController::approveEditKeyword($keywordTemp);
        }
        return redirect()->route('keywordTempList')->with($notification);
    }

    /**
     * Approve adding new keyword 
     * @param  [type] $keywordTemp [description]
     * @return [type]              [description]
     */
    public function approveAddKeyword($keywordTemp) {
        try {
            $keyword = Keyword::find($keywordTemp->old_keyword_id);
            $keyword->status = APPROVED;
            $keywordTemp->status = APPROVED;
            
            DB::beginTransaction();
            $keyword->save();
            $keywordTemp->save();
            DB::commit();
            
            $notification = array(
                'message' => 'Keyword \'' . $keyword['keyword'] . '\' added successfully.',
                'alert-type' => 'success'
            );
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'error'
            );
        }
        return $notification;
    }

    /**
     * Approve editing keyword
     * @param  [type] $keywordTemp [description]
     * @return [type]              [description]
     */
    public function approveEditKeyword($keywordTemp) {
        try {
            $keyword = Keyword::find($keywordTemp['old_keyword_id']);
            $notification = array(
                'message' => 'Keyword edited successfully. <br>\'' . $keyword->keyword . '\' to \'' . $keywordTemp['new_keyword'] . '\'',
                'alert-type' => 'success'
            );
            $keyword->keyword = $keywordTemp['new_keyword'];
            $keywordTemp->status = APPROVED;
            
            DB::beginTransaction();
            $keyword->save();
            $keywordTemp->save();
            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'error'
            );
        }
        return $notification;
    }

    /**
     * Decline request on keyword table
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function declineChangesOnKeywordTable(Request $request) {
        if ($request->has('id')) {
            $keywordTemp = KeywordTemp::find($request->id);
            try {
                $keywordTemp->status = DECLINED;
                $keywordTemp->comment = $request->get('cmt');
                
                DB::beginTransaction();
                $keywordTemp->save();
                DB::commit();
                
                $notification = array(
                    'message' => 'Request declined successfully.',
                    'alert-type' => 'success'
                );
            } catch (\Exception $e) {
                DB::rollback();
                $notification = array(
                    'message' => 'Something went wrong.',
                    'alert-type' => 'error'
                );
            }
        } else {
            $notification = array(
                'message' => 'Request is not exist.',
                'alert-type' => 'error'
            );
        }
        return response()->json($notification);
    }

    /**
     * Delete a request
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteRequest(Request $request) {
        try {
            $keywordTemp = KeywordTemp::find($request->id);
            $keywordTemp->status = DELETED;
            
            DB::beginTransaction();
            $keywordTemp->save();
            DB::commit();
            
            $notification = array(
                'message' => 'Request deleted.',
                'alert-type' => 'success'
            );
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('keywordTempList')->with($notification);
    }

    /**
     * return list request on meaning table
     * @return [type] [description]
     */

    public function indexMeaningTemp()
    {
        return view('admin.approve.meaning.list');
    }

    public function postDataForMeaningTemp(Request $request)
    {
        $list = IN_QUEUE;
        if ($request->has('list')) {
            $list = $request->list;
        }
        $result = MeaningTemp::where('status', $list)->get();
        $data = array();
        foreach ($result as $key => $value) {
            $sub = array(
                $value['id'], 
                $value['opCode'], 
                $value->user->email, 
                $value->keyword['keyword'],
                $value->oldMeaning['meaning'],
                $value->new_meaning,
                $value['comment']
            );
            $data[] = $sub;
        }
        $output = array('data' => $data);
        return response()->json($output);
    }

    /**
     * Approve changes on meaning table
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function approveChangesOnMeaningTable(Request $request) {
        $notification = array(
            'message' => 'Request is not exist.',
            'alert-type' => 'error'
        );
        $opCode = $request->opCode;
        $meaningTemp = MeaningTemp::find($request->id);
        if (!$request->has('opCode') || !$request->has('id') || ($opCode != ADD && $opCode != EDIT)) {
            $notification = array(
                'message' => 'Invalid request.',
                'alert-type' => 'error'
            );
        }
        if (isset($opCode) && $opCode == ADD && $meaningTemp != null) {
            $notification = AdminController::approveAddMeaning($meaningTemp);
        }
        if ($opCode == EDIT && $meaningTemp != null) {
            $notification = AdminController::approveEditMeaning($meaningTemp);
        }
        return redirect()->route('meaningTempList')->with($notification);
    }

    public function approveAddMeaning($meaningTemp) {
        try {
            $meaningTemp->status = APPROVED;
            
            DB::beginTransaction();
            $meaning = Meaning::create([
                'meaning' => $meaningTemp['new_meaning'],
                'status' => APPROVED,
                'language' => $meaningTemp['language'],
                'index' => $meaningTemp['index'],
                'keyword_id' => $meaningTemp['keyword_id']
            ]);
            $meaningTemp->save();
            DB::commit();
            
            $notification = array(
                'message' => "Successfully added new meaning.<br>" . $meaning->keyword['keyword'] . ' : ' . $meaning->meaning,
                'alert-type' => 'success'
            );
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'error'
            );
        }
        return $notification;
    }

    public function approveEditMeaning($meaningTemp) {
        try {
            $meaning = Meaning::find($meaningTemp['old_meaning_id']);
            $meaning->meaning = $meaningTemp['new_meaning'];
            $meaningTemp->status = APPROVED;
            
            DB::beginTransaction();            
            $meaning->save();
            $meaningTemp->save();
            DB::commit();
            
            $notification = array(
                'message' => 'Successfully edited meaning.',
                'alert-type' => 'success'
            );
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'error'
            );
        }
        return $notification;
    }

    /**
     * Decline changes on meaning table
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function declineChangesOnMeaningTable(Request $request) {
        if (!$request->has('id')) {
            $notification = array(
                'message' => 'Invalid request.',
                'alert-type' => 'error'
            );
        }
        $meaningTemp = MeaningTemp::find($request->id);
        if ($meaningTemp != null) {
            try {
                $meaningTemp->status = DECLINED;
                $meaningTemp->comment = $request->get('cmt');
                
                DB::beginTransaction();
                $meaningTemp->save();
                DB::commit();
                
                $notification = array(
                    'message' => 'Request declined successfully.',
                    'alert-type' => 'success'
                );
            } catch (\Exception $e) {
                DB::rollback();
                $notification = array(
                    'message' => 'Something went wrong.',
                    'alert-type' => 'error'
                );
            }
        } else {
            $notification = array(
                'message' => 'Request is not exist.',
                'alert-type' => 'error'
            );
        }
        return response()->json($notification);
    }

    public function deleteRequestOnMeaningTable(Request $request) {
        try {
            $meaningTemp = MeaningTemp::find($request->id);
            $meaningTemp->status = DELETED;
            
            DB::beginTransaction();
            $meaningTemp->save();
            DB::commit();
            
            $notification = array(
                'message' => 'Request deleted successfully.',
                'alert-type' => 'success'
            );
        } catch (\Exception $e) {
            DB::rollback();
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('meaningTempList')->with($notification);
    }
}

