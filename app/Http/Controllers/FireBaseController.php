<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Reclamation;
//use Kreait\Firestore\Factory;
use Google\Cloud\Firestore\FirestoreClient;

class FireBaseController extends Controller
{
    //
    protected $db;
    protected $name;
    
    public function __construct(){
            $this->db = new FirestoreClient([
                'projectId'=> 'minicipalite-app'
                ]);
            $this->name = 'posts';
    }
    public function index(){
        //$factory = (new Factory)->withServiceAccount(__DIR__.'/firebasekey.json');
        //$datebase = $factory->getFirestore();
        //$reference = $database->getReference('posts');
        //$key = $ref->push->getKey();
        //return $key;
        $reclamationsDb = Reclamation::all();
        $posts = $this->db->collection($this->name);
        $documents = $posts->documents();
        $reclamations = Array();
        foreach ($documents as $document) {
            if ($document->exists()) {
                //printf('Document data for document %s:' . PHP_EOL, $document->id());
                //print_r($document->data());
                //printf(PHP_EOL);
                $doc = $document->data();
                $doc['id'] = $document->id();

                $existe = false;
                foreach($reclamationsDb as $recDb){
                    if($recDb['idreclamation'] == $doc['id'] ){
                        $existe = true;
                    }

                }

                if (!$existe){
                    array_push($reclamations, $doc);
                }
                
            } 
        }
        //dd($reclamations);
        //return $reclamations;

        
        return view('homefirestore')->with('reclamations',$reclamations);

      
        
    }
    public function getDocument(String $name){
        try {
           
            
            return $this->db->collection($this->name)->document($name)->snapshot()->data();
          
        
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function delete($name){
        $this->db->collection($this->name)->document($name)->delete();
        return redirect()->back();
    }

    public function reclamationsT(){
        $reclamationsDb = Reclamation::all();
        $posts = $this->db->collection($this->name);
        $documents = $posts->documents();
        $reclamations = Array();
        foreach ($documents as $document) {
            if ($document->exists()) {
                //printf('Document data for document %s:' . PHP_EOL, $document->id());
                //print_r($document->data());
                //printf(PHP_EOL);
                $doc = $document->data();
                $doc['id'] = $document->id();
                $existe = false;
                foreach($reclamationsDb as $recDb){
                    if($recDb['idreclamation'] == $doc['id'] ){
                        $existe = true;
                    }

                }

                if ($existe){
                    array_push($reclamations, $doc);
                }
              
            } 
        }
        //dd($reclamations);
        //return $reclamations;
        return view('reclamationst')->with('reclamations',$reclamations)->with('reclamationsDb',$reclamationsDb);


    }

    public function changeState($name){

        $batch = $this->db->batch();
        $sfRef = $this->db->collection($this->name)->document($name);
        $batch->update($sfRef, [
            ['path' => 'status', 'value' => "traitee"]
        ]);

        $batch->commit();

        $reclamationDb = Reclamation::where('idreclamation',$name)->get();
        $reclamationDb[0]->etat = "traitee";
        $reclamationDb[0]->update();
        
        return redirect('/cheef/reclamations/traitee');
      
    }

    public function addPeriorite(Request $request){
        $rec = new Reclamation();
        $rec->idreclamation =  $request->input('idreclamation');
        $rec->periorite = $request->input('periorite');
        $rec->save();
        return redirect('/admin/reclamations/traitee');

    }

    public function cheefencours(){
        $reclamationsDb = Reclamation::where('etat','En cours')->get();
        $posts = $this->db->collection($this->name);
        $documents = $posts->documents();
        $reclamations = Array();
        foreach ($documents as $document) {
            if ($document->exists()) {
                //printf('Document data for document %s:' . PHP_EOL, $document->id());
                //print_r($document->data());
                //printf(PHP_EOL);
                $doc = $document->data();
                $doc['id'] = $document->id();
                $existe = false;
                foreach($reclamationsDb as $recDb){
                    if($recDb['idreclamation'] == $doc['id'] ){
                        $existe = true;
                    }

                }

                if ($existe){
                    array_push($reclamations, $doc);
                }
              
            } 
        }


        return view('reclamationscheefenc')->with('reclamations',$reclamations)->with('reclamationsDb',$reclamationsDb);
    }

    public function cheeftraitee(){
        $reclamationsDb = Reclamation::where('etat','traitee')->get();
        $posts = $this->db->collection($this->name);
        $documents = $posts->documents();
        $reclamations = Array();
        foreach ($documents as $document) {
            if ($document->exists()) {
                //printf('Document data for document %s:' . PHP_EOL, $document->id());
                //print_r($document->data());
                //printf(PHP_EOL);
                $doc = $document->data();
                $doc['id'] = $document->id();
                $existe = false;
                foreach($reclamationsDb as $recDb){
                    if($recDb['idreclamation'] == $doc['id'] ){
                        $existe = true;
                    }

                }

                if ($existe){
                    array_push($reclamations, $doc);
                }
              
            } 
        }
        return view('reclamationscheef')->with('reclamations',$reclamations)->with('reclamationsDb',$reclamationsDb);
    }

}
