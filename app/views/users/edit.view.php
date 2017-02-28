<?php partial('header', ['title' => "Register"]); ?>
<?php if(\App\Core\Session::isLogin()):?>
    <?php if ($oldreq): ?>
    <div class="ui container">
        <h1 class="ui header">User Creation</h1>
        <form class="ui form" action="/users/<?=$user->id?>" method="post" enctype="multipart/form-data">
            <?= method_field("PUT");?>
            <?= csrf_field();?>
            <h4 class="ui dividing header">User Information</h4>
            <div class="field">
                <label>Name</label>
                <div class="two fields">
                    <div class="field">
                        <input type="text" name="firstname" placeholder="First Name"
                               value="<?= $oldreq['fields']['firstname'] ?>">
                    </div>
                    <div class="field">
                        <input type="text" name="lastname" placeholder="Last Name"
                               value="<?= $oldreq['fields']['lastname'] ?>">
                    </div>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>User Name</label>
                    <input type="text" name="username" placeholder="User Name"
                           value="<?= $oldreq['fields']['username'] ?>" >
                </div>
                <div class=" field">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="email" value="<?= $oldreq['fields']['email'] ?>">
                </div>
            </div>
            <div class=" field">
                <label>Password</label>
                <div class="two fields">
                    <div class="field">
                        <input type="password" name="password" placeholder="Password"
                               value="<?= $oldreq['fields']['password'] ?>">
                    </div>
                    <div class=" field">
                        <input type="password" name="confirm" placeholder="Confirm Password"
                               value="<?= $oldreq['fields']['confirm'] ?>">
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Address</label>
                <input type="text" name="address" placeholder="Street Address"
                       value="<?= $oldreq['fields']['address'] ?>">
            </div>
            <div class=" two fields">
                <div class="field">
                    <label>Gender</label>
                    <select class="ui fluid dropdown" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="field">
                    <label>Country</label>
                    <select class="ui fluid dropdown" name="country">
                        <option value="egypt">Egypt</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            <div class="field">
                <label>Role</label>
                <select class="ui fluid dropdown" name="role">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div class="field">
                <label>Image</label>
                <input type="file" name="image" >
            </div>
            <div class="ui input" tabindex="0"><input type="submit" value="Submit"></div>
        </form>
        <div class="ui error message">
            <div class="header">Validation Errors</div>
            <?php partial('errors', ['errors' => $oldreq['errors']]) ?>
        </div>
    </div>
<?php else:?>
    <div class="ui container">
        <h1 class="ui header">User Registration</h1>
        <form class="ui form" action="/register" method="post" enctype="multipart/form-data">
            <h4 class="ui dividing header">User Information</h4>
            <div class="field">
                <label>Name</label>
                <div class="two fields">
                    <div class="field">
                        <input type="text" name="firstname" placeholder="First Name" value="<?= $user->firstname ?>">
                    </div>
                    <div class="field">
                        <input type="text" name="lastname" placeholder="Last Name" value="<?= $user->lastname ?>">
                    </div>
                </div>
            </div>
            <div class="two fields">
                <div class="field">
                    <label>User Name</label>
                    <input type="text" name="username" placeholder="User Name" value="<?= $user->username ?>">
                </div>
                <div class=" field">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="email" value="<?= $user->email ?>">
                </div>
            </div>
            <div class=" field">
                <label>Password</label>
                <div class="two fields">
                    <div class="field">
                        <input type="password" name="password" placeholder="Password" value="<?= $user->password ?>">
                    </div>
                    <div class=" field">
                        <input type="password" name="confirm" placeholder="Confirm Password" value="<?= $user->password ?>">
                    </div>
                </div>
            </div>
            <div class="field">
                <label>Address</label>
                <input type="text" name="address" placeholder="Street Address" value="<?= $user->address ?>">
            </div>
            <div class=" two fields">
                <div class="field">
                    <label>Gender</label>
                    <select class="ui fluid dropdown" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="field">
                    <label>Country</label>
                    <select class="ui fluid dropdown" name="country">
                        <option value="egypt">Egypt</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
            <div class="field">
                <label>Role</label>
                <select class="ui fluid dropdown" name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>

                </select>
            </div>
            <div class="field">
                <label>Image</label>
                <input type="file" name="image">
            </div>
            <div class="ui input" tabindex="0"><input type="submit" value="Submit"></div>
        </form>
    </div>
<?php endif;?>
<?php else:?>
    <div class="ui middle aligned center aligned grid" style="padding: 300px">
        <div class="column">
            <div class="ui vertical beg segment transition visible" >
                <div class="ui red header">
                    <i class="disabled warning sign icon"></i>
                    <div class="content">
                        <h1>No Login Found</h1>
                        <div class="sub header">
                            <p>Please login first</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
<?php partial('footer'); ?>
