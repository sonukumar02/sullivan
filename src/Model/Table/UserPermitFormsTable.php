<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Core\Configure;

class UserPermitFormsTable extends Table {

    function initialize(array $config) {
        parent::initialize($config);
        $this->addBehavior('Timestamp');
        $this->setTable('user_permit_forms');
        
      /*  $this->belongsTo('UserLocations', [
          'className' => 'UserLocations',
          'foreignKey' => 'user_location_id',
        ]);*/
       
    }

    /**
     * 
     * @return array list
     */
    public function saveData($permitId,$userPermitId,$data) {
    	    $this->updateAll(['is_deleted'=>1],['user_permit_id'=>$userPermitId,'permit_form_id'=>$data['permit_form_id']]); 
            $result = ''; 
            $userPermit = $this->newEntity();            
            $userPermit->user_id = Configure::read('LoggedCompanyId');
            $userPermit->permit_form_id = $data['permit_form_id'];
            $userPermit->user_permit_id  = $userPermitId;
            $userPermit->permit_id  = $permitId;
            $userPermit->file  = $data['file'];
            $userPermit->security_type_id = $data['security_type_id'];
            $userPermit->added_by = Configure::read('LoggedUserId');
            $result = $this->save($userPermit);
            return $result;
    }

}

?>
