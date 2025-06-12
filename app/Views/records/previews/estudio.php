<p class="paragraph">
    Quien suscribe <span class="record-data"><?= esc(get_setting('principal_name')) ?></span>, portador de la cédula de identidad Nº <span class="record-data"><?= esc(get_setting('principal_ci')) ?></span>, en mi condición de Director (e) de la <span class="record-data"><?= esc(get_setting('school_name')) ?></span>, ubicada en la <?= esc(get_setting('school_address')) ?> de esta ciudad de <?= esc(get_setting('school_longcity')) ?>.
</p>
<p class="paragraph">
    Por medio de la presente, hago constar que el (la) estudiante: <span class="record-data"><?= esc($data['primer_nombre']) ?> <?= esc($data['segundo_nombre']) ?> <?= esc($data['primer_apellido']) ?> <?= esc($data['segundo_apellido']) ?></span>, 
    cédula de identidad / escolar <span class="record-data"><?= formatCedulaEx($data['cedula'], $data['nacionalidad'] ?? '', $data['tipo_cedula'] ?? '') ?></span>, de <span class="record-data"><?= esc($data['edad']) ?></span> de edad, natural de: <span class="record-data"><?= esc($data['birthcity']) ?></span>,
    estado: <span class="record-data"><?= esc($data['state']) ?></span>, <span class="rdata-wul"><?= esc($data['cursa_curso'] === 'curso' ? 'cursó' : 'cursa') ?></span> estudios en el nivel de <span class="record-data"><?= esc($data['nivel']) ?></span>, en el (la) <span class="record-data"><?= esc($data['grado']) ?></span>, Sección: <span class="record-data">"<?= esc($data['seccion']) ?>"</span> durante el año escolar: <span class="record-data"><?= esc($data['periodo_escolar']) ?></span>,
    en este prestigiodo plantel educativo.
</p>
<p class="paragraph">
    Constancia que se emite en <?= esc(get_setting('school_shortcity')) ?> a los <?= literalRecordDate(true) ?>.
</p>