<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'title' => 'Sarlavha',
            'short_content' => 'Qisqacha mazmun',
            'mazmun' => 'Maqola',
            'photo' => 'Rasm'
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'title'=>'required|max:255',
            'short_content'=>'required',
            'content'=>'required',
            'photo' => 'nullable | image|max:2048'



        ];
    }
    // function generateUpToDateMimeArray($url){
    //     $s=array();
    //     foreach(@explode("\n",@file_get_contents($url))as $x)
    //         if(isset($x[0])&&$x[0]!=='#'&&preg_match_all('#([^\s]+)#',$x,$out)&&isset($out[1])&&($c=count($out[1]))>1)
    //             for($i=1;$i<$c;$i++)
    //                 $s[]='&nbsp;&nbsp;&nbsp;\''.$out[1][$i].'\' => \''.$out[1][0].'\'';
    //     return @sort($s)?'$mime_types = array(<br />'.implode($s,',<br />').'<br />);':false;
    // }
}
