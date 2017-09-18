<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polling extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('upload'));
	}
	public function get_question($param = 0)
	{
		$this->db->where('question_id', $param);
		return $this->db->get('pollingquestion')->row();
	}

	public function get_all_question()
	{
		return $this->db->get('pollingquestion')->result();
	}

	public function get_answers($param = 0)
	{
		$this->db->where('question_id', $param);
		return $this->db->get('pollinganswer')->result();
	}

	public function save_polling()
	{
		if( $this->valid_polling( $this->input->post('post') ) == FALSE)
		{
			$this->db->insert('pollingrespondent', array(
				'pollingpost_id' => $this->input->post('post'),
				'user_id' => $this->session->userdata('user')->ID,
				'answer_id' => $this->input->post('answer'),
				'response_date' => date('Y-m-d H:i:s')
			));
		} else {
			$this->db->update('pollingrespondent', array(
				'answer_id' => $this->input->post('answer'),
				'response_date' => date('Y-m-d H:i:s')
			), array(
				'pollingpost_id' => $this->input->post('post'),
				'user_id' => $this->session->userdata('user')->ID,
			));
		}

		return $this->db->affected_rows();
	}

	public function save_polling_session()
	{
		foreach( $this->cart->contents() as $data )
		{
			if( $this->valid_polling($data['post']) == FALSE)
			{
				$this->db->insert('pollingrespondent', array(
					'pollingpost_id' => $data['post'],
					'user_id' => $this->session->userdata('user')->ID,
					'answer_id' => $data['answer'],
					'response_date' => date('Y-m-d H:i:s')
				));
			} else {
				$this->db->update('pollingrespondent', array(
					'answer_id' => $data['answer'],
					'response_date' => date('Y-m-d H:i:s')
				), array(
					'pollingpost_id' => $data['post'],
					'user_id' => $this->session->userdata('user')->ID,
				));
			}
		}
		
		$this->cart->destroy();
	}

	public function valid_polling($post = 0)
	{
		return $this->db->get_where('pollingrespondent', array(
			'pollingpost_id' => $post,
			'user_id' => $this->session->userdata('user')->ID
		))->num_rows();
	}

	public function get_question_pg($limit = 15, $offset = 0, $type = 'result')
	{
		if( $this->input->get('query') != '')
			$this->db->like('question', $this->input->get('query'));
		if( $type == 'result')
		{
			return $this->db->get('pollingquestion',$limit, $offset)->result();
		} else {
			return $this->db->get('pollingquestion')->num_rows();
		}
	}

	public function create_polling()
	{
	    $this->db->insert('pollingquestion', array(
	    	'question' => $this->input->post('question')
	    ));

	    $question = $this->db->insert_id();

	    $this->inserts_icon($question);

		$this->template->alert(
			' Polling berhasil ditambahkan. ', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function inserts_icon($question = FALSE)
	{
		$hasilUpload = array();

		$object = array();

		if( $question == TRUE)
		{
			$jumlahfiles = count(@$_FILES['perasaan']['name']);

		    // Faking upload calls to $_FILES
		    for ($i = 0; $i < $jumlahfiles; $i++) 
		    {
		    	$_FILES['perasaan']['name']     = $_FILES['perasaan']['name'][$i];
		    	$_FILES['perasaan']['type']     = $_FILES['perasaan']['type'][$i];
		    	$_FILES['perasaan']['tmp_name'] = $_FILES['perasaan']['tmp_name'][$i];
		    	$_FILES['perasaan']['error']    = $_FILES['perasaan']['error'][$i];
		    	$_FILES['perasaan']['size']     = $_FILES['perasaan']['size'][$i];
		    	$config = array(
		        	'file_name'     => $_FILES['perasaan']['name'][$i],
		        	'allowed_types' => 'jpg|jpeg|png|gif|svg',
		        	'max_size'      => 20000,
		        	'overwrite'     => FALSE,
		        	'upload_path' 	=>'./public/image/polling'
		    	);
		      
		      	$this->upload->initialize($config);
		      
		      	if ( ! $this->upload->do_upload()) 
		      	{
			        continue;
		      	} else {
		      		$hasilUpload[] = $this->upload->data();

		      		$object[] = array(
		      			'question_id' => $question,
		      			'label' => $this->input->post('jawaban')[$i],
		      			'icon' => $hasilUpload[$i]['file_name']
		      		);
		      	}
		    }

		    if( $jumlahfiles >= 1)
		    	$this->db->insert_batch('pollinganswer', $object);
		}
	}

	public function update_polling($param = 0)
	{
	    $this->db->update('pollingquestion', array(
	    	'question' => $this->input->post('question')
	    ), array(
	    	'question_id' => $param
	    ));

	    /** 
	    * Validation set
	    * 
		* @link http://php.net/manual/en/features.file-upload.multiple.php
	    */
		$filesUpdate = function($files)
		{
		    $names = array( 'name' => 1, 'type' => 1, 'tmp_name' => 1, 'error' => 1, 'size' => 1);

		    foreach ($files as $key => $part) 
		    {
		        // only deal with valid keys and multiple files
		        $key = (string) $key;
		        if (isset($names[$key]) && is_array($part)) 
		        {
		            foreach ($part as $position => $value) 
		            {
		            	if( $value == FALSE OR $key == 'error')
		            		continue;

		                $files[$position][$key] = $value;
		            }
		            // remove old key reference
		            unset($files[$key]);
		        }
		    }

		    return $files;
		};

		foreach ($filesUpdate($_FILES['icon']) as $key => $file) 
		{
		    move_uploaded_file($file['tmp_name'],'./public/image/polling/'.$file['name']);

		    $answer = $this->get_answersId( $key );

		    if( $answer->icon != '')
		    	@unlink("./public/image/polling/{$answer->icon}");

		    $this->db->update('pollinganswer', array(
		      	'icon' => $file['name']
		    ), array(
		     	'question_id' => $param,
		     	'answer_id' => $key
		    ));		    
		}

		foreach ($this->input->post('label') as $key => $value) 
		    $this->db->update('pollinganswer', array(
		      	'label' => $this->input->post('label')[$key]
		    ), array(
		     	'question_id' => $param,
		     	'answer_id' => $key
		    )
		);	

	    $this->inserts_icon($param);

		$this->template->alert(
			' Polling berhasil diubah. ', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function get_answersId($param = 0)
	{
		return $this->db->get_where('pollinganswer', array('answer_id' => $param))->row();
	}

	public function delete($param = 0)
	{
		foreach( $this->get_answers( $param ) as $row)
		{
			$this->db->delete('pollingrespondent', array('answer_id' => $row->answer_id));

		    if( $row->icon != '')
		    	@unlink("./public/image/polling/{$row->icon}");
		}

		$this->db->delete('pollingpost', array('question_id' => $param));

		$this->db->delete('pollingquestion', array('question_id' => $param));

		$this->template->alert(
			' Polling berhasil dihapus. ', 
			array('type' => 'success','icon' => 'check')
		);
	}

	public function delete_answer($param = 0)
	{
		$answer = $this->get_answersId( $param );

		if( $answer->icon != '')
			@unlink("./public/image/polling/{$answer->icon}");

		$this->db->delete('pollinganswer', array('answer_id' => $param));

		if( $this->db->affected_rows() )
		{
			return array('status' => 'success');
		} else {
			return array('status' => 'failed');
		}
	}
}

/* End of file Polling.php */
/* Location: ./application/models/Polling.php */