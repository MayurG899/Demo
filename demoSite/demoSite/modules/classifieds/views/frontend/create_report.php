<link href="<?=base_url('modules/classifieds/assets/css/bootstrap.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/theme.css')?>" rel="stylesheet">
<link href="<?=base_url('modules/classifieds/assets/css/style.css')?>" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 style="margin-bottom: 20px">File a report</h2>
            <form method="post">
                <div class="form-group" style="margin-bottom: 10px">
                    <label>Your name:</label>
                    <input type="text" class="form-control" name="name" placeholder="name" required <?if (isset($member->name)) echo 'value="'.$member->name.'"';?>>
                </div> 
                <div class="form-group" style="margin-bottom: 10px">
                    <label>Your email:</label>
                    <input type="text" class="form-control" name="email" placeholder="email address" required <?if (isset($member->email)) echo 'value="'.$member->email.'"';?>>
                </div>
                <div class="form-group" style="margin-bottom: 10px">
                    <label>Category:</label>
                    <select class="form-control" name="category" required>
                        <option value="">Select category</option>
                        <option value="Animal Welfare Concern">Animal Welfare Concern</option>
                        <option value="Breach of T&amp;Cs">Breach of T&amp;Cs</option>
                        <option value="Suspected Fraud">Suspected Fraud</option>
                        <option value="Suspected Stolen Goods">Suspected Stolen Goods</option>
                        <option value="Suspected Counterfeit Goods">Suspected Counterfeit Goods</option>
                        <option value="Can't contact seller">Can't contact seller</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 10px">
                    <label>Complain:</label>
                    <textarea name="complain" class="form-control" placeholder="text" style="height:100px" required></textarea>
                    <input type="hidden" name="time_of_creation" value="<?=date('H:i:s d/m/Y ')?>">
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>