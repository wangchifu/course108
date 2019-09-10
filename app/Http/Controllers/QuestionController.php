<?php

namespace App\Http\Controllers;

use App\Part;
use App\Question;
use App\Topic;
use App\Year;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $part_order_by = [
            '1'=>'壹','2'=>'貳','3'=>'參','4'=>'肆','5'=>'伍','6'=>'陸','7'=>'柒','8'=>'捌','9'=>'玖','10'=>'拾'
        ];
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
                $topic_items[$topic->id] = $topic->order_by.'.'.$topic->title;
            }
        }

        $data = [
            'part_order_by'=>$part_order_by,
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
}
