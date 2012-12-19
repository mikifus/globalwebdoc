<div class='block'>
    <div class='title'>
        Login
    </div>
    <div class='padding_10'>
        <h4>
            <?/*=$this->Session->flash('auth')*/?>
        </h4>
        <div>
            <?/*=$facebook->login()*/?>
        </div>
        <div>
            <div class='margintop_20'>
                <?php
                // if(is_null($this->auth)){
                    echo $this->Form->create('User', array('action' => 'login'));
                    echo $this->Form->input('username',array('between'=>'<br>','class'=>'text'));
                    echo $this->Form->input('password',array('between'=>'<br>','class'=>'text'));
                    echo $this->Form->end('Login');
                // }
                ?>
            </div>
        </div>
    </div>
</div>