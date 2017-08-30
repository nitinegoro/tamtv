	<ul class="top-trending-tags">
		<?php  
			foreach ($this->tags->box(3) as $row) 
			{
				echo '<li><a href="'.base_url("tag/{$row->slug}").'">'.$row->name.'</a></li>';
			}
		?>
	</ul>