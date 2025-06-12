<p class="paragraph">
    Quien suscribe <span class="record-data"><?= esc(get_setting('principal_name')) ?></span>, titular de la cédula Nº <span class="record-data"><?= esc(get_setting('principal_ci')) ?></span>, en mi condición de <span class="rdata-wul"><?= esc(get_setting('principal_position')) ?></span> de la <span class="record-data"><?= esc(get_setting('school_name')) ?></span>, institución con el código plantel <span class="record-data"><?= esc(get_setting('dea_code')) ?></span>,
    ubicado en la <?= esc(get_setting('school_address')) ?> de esta ciudad de <?= esc(get_setting('school_longcity')) ?>. Por medio de la presente, hago constar que el (la) estudiante: <span class="record-data"><?= esc($data['primer_nombre']) ?> <?= esc($data['segundo_nombre']) ?> <?= esc($data['primer_apellido']) ?> <?= esc($data['segundo_apellido']) ?></span>, 
    portador(a) de la cédula/cédula escolar <span class="record-data"><?= formatCedulaEx($data['cedula'], $data['nacionalidad'] ?? '', $data['tipo_cedula'] ?? '') ?></span>, cursa estudios en el (la) <span class="record-data"><?= esc($data['grado']) ?></span>, Sección: <span class="record-data">"<?= esc($data['seccion']) ?>"</span> del nivel de <span class="record-data"><?= esc($data['nivel']) ?></span>, durante el año escolar <span class="record-data"><?= esc($data['periodo_escolar']) ?></span>,
    demostrando en todo momento una <span class="record-data">buena conducta</span>.
</p>
<p class="paragraph">
    Constancia que se expide de la parte interesada a los <?= literalRecordDate(true) ?>.
</p>