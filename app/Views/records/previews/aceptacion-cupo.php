<p class="paragraph">
    Quien suscribe <span class="record-data"><?= esc(get_setting('principal_name')) ?></span>, titular de la cédula de identidad Nº <span class="record-data"><?= esc(get_setting('principal_ci')) ?></span>, en mi condición de <span class="rdata-wul"><?= esc(get_setting('principal_position')) ?></span> de este prestigioso plantel educativo. Por medio de la presente, hago constar que el (la) ciudadano (a): 
    <span class="record-data"><?= esc($data['rprimer_nombre']) ?> <?= esc($data['rsegundo_nombre']) ?> <?= esc($data['rprimer_apellido']) ?> <?= esc($data['rsegundo_apellido']) ?></span>, titular de la cédula de identidad Nº <span class="record-data"><?= formatCedulaEx($data['r-cedula'], $data['r-nacionalidad'] ?? '', 'cidentidad') ?></span>, solicitó cupo para su representado:
    <span class="record-data"><?= esc($data['primer_nombre']) ?> <?= esc($data['segundo_nombre']) ?> <?= esc($data['primer_apellido']) ?> <?= esc($data['segundo_apellido']) ?></span>, de <span class="record-data"><?= esc($data['edad']) ?></span> años, 
    cédula escolar/cédula <span class="record-data"><?= formatCedulaEx($data['cedula'], $data['nacionalidad'] ?? '', $data['tipo_cedula'] ?? '') ?></span> del nivel de <span class="record-data">educación <?= esc($data['nivel']) ?></span> a partir de la presente fecha. Para cursar el (la) 
    <span class="record-data"><?= esc($data['grado']) ?></span>, año escolar <span class="record-data"><?= esc($data['periodo_escolar']) ?></span>,
</p>
<p class="paragraph">
    Constancia que se expide a los <?= literalRecordDate(true) ?>.
</p>