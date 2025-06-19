<p class="paragraph">
    Quien suscribe <span class="record-data"><?= esc(get_setting('principal_name')) ?></span>, titular de la cédula de identidad Nº <span class="record-data"><?= esc(get_setting('principal_ci')) ?></span>, en mi condición de <span class="rdata-wul"><?= esc(get_setting('principal_position')) ?></span> de la <span class="record-data"><?= esc(get_setting('school_name')) ?></span> que funciona en la <?= esc(get_setting('school_address')) ?> de esta ciudad de <?= esc(get_setting('school_longcity')) ?>.
</p>
<p class="paragraph">
    Por medio de la presente hago constar que se acepta como recurso el o (la) ciudadano(a) <span class="record-data"><?= esc($data['primer_nombre']) ?> <?= esc($data['segundo_nombre']) ?> <?= esc($data['primer_apellido']) ?> <?= esc($data['segundo_apellido']) ?></span>, 
    titular de la cédula de identidad N° <span class="record-data"><?= formatCedulaEx($data['cedula'], $data['nacionalidad'] ?? '') ?></span> personal con el cargo: <span class="record-data"><?= esc($data['cargo_funciones']) ?></span>, para ser asignado al nivel de <span class="record-data">educación <?= esc($data['nivel']) ?></span>, a partir de la presente fecha.
</p>
<p class="paragraph">
    <b>Nota:</b> <span class="money">El funcionario(a) deberá consignar carta de liberación y se le tramitará el movimiento respectivo.</span>
</p>
<p class="paragraph">
    Constancia que se emite en <?= esc(get_setting('school_shortcity')) ?> a los <?= literalRecordDate(true) ?>.
</p>