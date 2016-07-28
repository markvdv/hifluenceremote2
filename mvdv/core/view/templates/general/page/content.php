<div id="contextmenu">
  <?php $this->views['contextmenu']->render();?>  
</div>
<button id="hidebutton">
    TOGGLE MENU
</button>
<div id="content">
     <?php foreach($this->views['content'] as $view){
         $view->render();
     };?> 
</div>