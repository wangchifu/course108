<?php

namespace App\Http\Controllers;

use App\Part;
use App\Question;
use App\Topic;
use App\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $part_order_by = config('course.part_order_by');
        $type_items = config('course.type_items');
        $g_s_items = config('course.g_s_items');

        //年度選單
        $year_items = Year::orderBy('year','DESC')->pluck('year','year')->toArray();
        //選擇的年度
        $select_year = ($request->input('year'))?$request->input('year'):current($year_items);
        $part_items = [];
        $topic_items = [];
        $parts = [];
        $topics = [];
        $questions = [];

        if($select_year){
            $parts = Part::where('year',$select_year)->orderBy('order_by')->get();
            foreach($parts as $part){
                $part_items[$part->id] = $part_order_by[$part->order_by].'.'.$part->title;
            }
            $topics = Topic::where('year',$select_year)->orderBy('order_by')->get();
            foreach($topics as $topic){
                $topic_items[$topic->id] = $topic->order_by.'.'.Str::limit($topic->title,30);
            }
        }

        $data = [
            'part_order_by'=>$part_order_by,
            'type_items'=>$type_items,
            'g_s_items'=>$g_s_items,
            'year_items'=>$year_items,
            'select_year'=>$select_year,
            'part_items'=>$part_items,
            'topic_items'=>$topic_items,
            'parts'=>$parts,
            'topics'=>$topics,

        ];
        return view('admin.questions.index',$data);
    }

    public function store_part(Request $request)
    {
        $att['order_by'] = $request->input('order_by');
        $att['title'] = $request->input('title');
        $att['year'] = $request->input('year');
        Part::create($att);
        return redirect()->route('questions.index');
    }

    public function store_topic(Request $request)
    {
        $att['order_by'] = $request->input('order_by');
        $att['title'] = $request->input('title');
        $att['part_id'] = $request->input('part_id');
        $att['year'] = $request->input('year');
        Topic::create($att);
        return redirect()->route('questions.index');
    }

    public function store_question(Request $request)
    {
        $att['order_by'] = $request->input('order_by');
        $att['title'] = $request->input('title');
        $att['topic_id'] = $request->input('topic_id');
        $att['type'] = $request->input('type');
        $att['need'] = $request->input('need');
        $att['g_s'] = $request->input('g_s');
        $att['year'] = $request->input('year');
        Question::create($att);
        return redirect()->route('questions.index');
    }

    public function delete_part(Part $part)
    {
        foreach($part->topics as $topic){
            foreach($topic->questions as $question){
                $question->delete();
            }
            $topic->delete();
        }
        $part->delete();
        return redirect()->route('questions.index');
    }

    public function delete_topic(Topic $topic)
    {
        foreach($topic->questions as $question){
            $question->delete();
        }
        $topic->delete();
        return redirect()->route('questions.index');
    }

    public function delete_question(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index');
    }

    public function edit_part($select_year,Part $part)
    {
        $part_order_by = config('course.part_order_by');

        $data = [
            'part'=>$part,
            'part_order_by'=>$part_order_by,
            'select_year'=>$select_year,
        ];

        return view('admin.questions.edit_part',$data);
    }

    public function update_part(Request $request,Part $part)
    {
        $att['order_by'] = $request->input('order_by');
        $att['title'] = $request->input('title');
        $att['year'] = $request->input('year');
        $part->update($att);
        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function edit_topic($select_year,Topic $topic)
    {
        $part_order_by = config('course.part_order_by');

        $parts = Part::where('year',$select_year)->orderBy('order_by')->get();
        foreach($parts as $part){
            $part_items[$part->id] = $part_order_by[$part->order_by].'.'.$part->title;
        }
        $data = [
            'topic'=>$topic,
            'part_items'=>$part_items,
            'select_year'=>$select_year,
        ];

        return view('admin.questions.edit_topic',$data);
    }

    public function update_topic(Request $request,Topic $topic)
    {
        $att['order_by'] = $request->input('order_by');
        $att['title'] = $request->input('title');
        $att['part_id'] = $request->input('part_id');
        $att['year'] = $request->input('year');
        $topic->update($att);
        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function edit_question($select_year,Question $question)
    {
        $type_items = config('course.type_items');
        $g_s_items = config('course.g_s_items');

        $topics = Topic::where('year',$select_year)->orderBy('order_by')->get();
        foreach($topics as $topic){
            $topic_items[$topic->id] = $topic->order_by.'.'.Str::limit($topic->title,30);
        }
        $data = [
            'type_items'=>$type_items,
            'g_s_items'=>$g_s_items,
            'question'=>$question,
            'select_year'=>$select_year,
            'topic_items'=>$topic_items,
        ];
        return view('admin.questions.edit_question',$data);
    }

    public function update_question(Request $request,Question $question)
    {
        $att['order_by'] = $request->input('order_by');
        $att['title'] = $request->input('title');
        $att['topic_id'] = $request->input('topic_id');
        $att['type'] = $request->input('type');
        $att['need'] = $request->input('need');
        $att['g_s'] = $request->input('g_s');
        $att['year'] = $request->input('year');
        $question->update($att);
        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function copy(Request $request)
    {
        $b_year = $request->input('b_year');
        $l_year = $request->input('l_year');

        //先刪除被複製年度的資料
        $l_parts = Part::where('year',$l_year)->get();
        foreach($l_parts as $part){
            foreach($part->topics as $topic){
                foreach($topic->questions as $question){
                    $question->delete();
                }
                $topic->deldete();
            }
            $part->delete();
        }

        //開始複製
        $b_parts = Part::where('year',$b_year)->get();
        foreach($b_parts as $part){
            $att['order_by'] = $part->order_by;
            $att['title'] = $part->title;
            $att['year'] = $l_year;
            $new_part = Part::create($att);

            foreach($part->topics as $topic){
                $att2['order_by'] = $topic->order_by;
                $att2['title'] = $topic->title;
                $att2['part_id'] = $new_part->id;
                $att2['year'] = $l_year;
                $new_topic = Topic::create($att2);

                foreach($topic->questions as $question){
                    $att3['order_by'] = $question->order_by;
                    $att3['title'] = $question->title;
                    $att3['topic_id'] = $new_topic->id;
                    $att3['type'] = $question->type;
                    $att3['need'] = $question->need;
                    $att3['g_s'] = $question->g_s;
                    $att3['year'] = $l_year;
                    Question::create($att3);
                }
            }
        }

        return redirect()->route('questions.index');
    }
}
