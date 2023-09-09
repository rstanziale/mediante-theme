<form action="https://example.com/register" accept-charset="UTF-8" method="post" target="_blank">
    <p class="fw-bold text-center text-primary">Newsletter</p>
    <div class="form-group">
        <div class="input-group">
            <input type="email" maxlength="64" id="mail" name="mail" value="" class="form-control form-control-sm" placeholder="esempio@dominio.com" required="" />
            <input type="hidden" name="form_id" value="user_register" />
            <input type="submit" name="submit" value="Iscriviti" class="btn btn-sm btn-dark" />
        </div>
        <small id="emailHelp" class="form-text text-muted">Non condivideremo la tua email con nessun altro.</small>
    </div>
    <div class="form-group mt-2">
        <div class="form-check">
            <input type="checkbox" id="privacy" name="privacy" value="1" class="form-check-input" required="" />
            <label class="form-check-label" for="privacy">
                Ho letto e accettato l'informativa <a class="text-muted" style="text-decoration: underline;" href="<?php echo get_privacy_policy_url()?>" target="_blank">privacy</a>
            </label>
        </div>
    </div>
</form>