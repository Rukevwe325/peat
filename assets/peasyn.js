(() => {
    document.querySelectorAll('[data-ps-visual]').forEach(visual => {
        const canvas = visual.querySelector('.psv-canvas');
        const context = canvas.getContext('2d');
        if (!context) return;

        const pause = visual.querySelector('.psv-pause');

        const motion = window.matchMedia('(prefers-reduced-motion: reduce)');
        const columns = 36;
        const rows = 14;
        const scale = Math.min(window.devicePixelRatio || 1, 2);
        canvas.width = 560 * scale;
        canvas.height = 340 * scale;
        context.scale(scale, scale);
        let field = new Float32Array(columns * rows);
        let next = new Float32Array(field.length);
        const duration = 12;
        let elapsed = 0;
        let paused = false;
        let visible = false;
        let frame = null;
        let lastUpdate = 0;

        // Dimensionless diffusion with a moving heat source and ambient cooling.
        // These illustrative settings are independent of PeaSyn's engineering models.
        const palette = Array.from({ length: 121 }, (_, value) => {
            const stops = [[23, 51, 78], [37, 123, 166], [89, 191, 208], [242, 191, 101], [255, 120, 71]];
            const position = value / 120 * (stops.length - 1);
            const index = Math.min(Math.floor(position), stops.length - 2);
            const fraction = position - index;
            return 'rgb(' + stops[index].map((channel, i) =>
                Math.round(channel + (stops[index + 1][i] - channel) * fraction)
            ).join(',') + ')';
        });

        const advance = () => {

            elapsed += 0.05;
            if (elapsed > duration + 4) {
                elapsed = 0;
                field.fill(0);
            }
            const source = elapsed / duration * (columns - 1);
            for (let step = 0; step < 4; step++) {
                for (let y = 0; y < rows; y++) {
                    for (let x = 0; x < columns; x++) {
                        const i = y * columns + x;
                        const temperature = field[i];
                        const neighbours = field[y * columns + Math.max(0, x - 1)]
                            + field[y * columns + Math.min(columns - 1, x + 1)]
                            + field[Math.max(0, y - 1) * columns + x]
                            + field[Math.min(rows - 1, y + 1) * columns + x];
                        const distance = (x - source) ** 2 + (y - (rows - 1) / 2) ** 2;
                        const heat = elapsed <= duration ? 10 * Math.exp(-distance / 1.6) : 0;
                        next[i] = Math.min(120, Math.max(0,
                            temperature + 0.09 * (neighbours - 4 * temperature) - 0.002 * temperature + heat
                        ));
                    }
                }
                [field, next] = [next, field];
            }
        };

        const draw = () => {
            const progress = Math.min(elapsed / duration, 1);
            const sourceX = 12 + progress * 416;
            const tipX = 115 + 0.9 * sourceX - 0.55 * 75;
            const tipY = 108 + 0.2 * sourceX + 0.55 * 75;
            context.clearRect(0, 0, 560, 340);

            // Ground grid and shadow give the simulation a sense of depth.
            context.strokeStyle = '#83c9ed0a';
            context.lineWidth = 1;
            for (let x = -240; x < 650; x += 44) {
                context.beginPath();
                context.moveTo(x, 80);
                context.lineTo(x + 330, 340);
                context.stroke();
                context.beginPath();
                context.moveTo(x + 540, 80);
                context.lineTo(x + 30, 340);
                context.stroke();
            }
            const shadow = context.createRadialGradient(280, 259, 15, 280, 259, 220);
            shadow.addColorStop(0, '#00000080');
            shadow.addColorStop(1, '#00000000');
            context.fillStyle = shadow;
            context.fillRect(25, 150, 510, 180);

            // Extruded edges of the workpiece.
            const edge = context.createLinearGradient(0, 185, 0, 292);
            edge.addColorStop(0, '#284f67');
            edge.addColorStop(1, '#102839');
            context.fillStyle = edge;
            context.strokeStyle = '#6a9bb855';
            context.beginPath();
            context.moveTo(32.5, 190.5);
            context.lineTo(428.5, 278.5);
            context.lineTo(511, 196);
            context.lineTo(511, 209);
            context.lineTo(428.5, 291.5);
            context.lineTo(32.5, 203.5);
            context.closePath();
            context.fill();
            context.stroke();

            // Project the evolving heat field onto the workpiece's upper surface.
            context.save();
            context.transform(0.9, 0.2, -0.55, 0.55, 115, 108);
            context.fillStyle = '#234358';
            context.fillRect(0, 0, 440, 150);
            const cellWidth = 440 / columns;
            const cellHeight = 150 / rows;
            for (let y = 0; y < rows; y++) {
                for (let x = 0; x < columns; x++) {
                    context.fillStyle = palette[Math.round(field[y * columns + x])];
                    context.fillRect(x * cellWidth, y * cellHeight, cellWidth + 0.4, cellHeight + 0.4);
                }
            }
            context.strokeStyle = '#b3d7eb20';
            context.lineWidth = 0.7;
            context.beginPath();
            for (let x = 0; x <= 440; x += 440 / 12) {
                context.moveTo(x, 0);
                context.lineTo(x, 150);
            }
            for (let y = 0; y <= 150; y += 150 / 7) {
                context.moveTo(0, y);
                context.lineTo(440, y);
            }
            context.stroke();
            context.strokeStyle = '#b9dff055';
            context.strokeRect(0, 0, 440, 150);

            context.lineWidth = 4;
            context.lineCap = 'round';
            context.strokeStyle = '#c6f1ff55';
            context.beginPath();
            context.moveTo(12, 75);
            context.lineTo(sourceX, 75);
            context.stroke();
            context.setLineDash([5, 7]);
            context.lineWidth = 1;
            context.strokeStyle = '#b4d4e94d';
            context.beginPath();
            context.moveTo(sourceX, 75);
            context.lineTo(428, 75);
            context.stroke();
            context.restore();

            if (elapsed <= duration) {
                // A compact metallic tool follows the active point of the model.
                const glow = context.createRadialGradient(tipX, tipY, 1, tipX, tipY, 35);
                glow.addColorStop(0, '#fff2aecc');
                glow.addColorStop(0.25, '#ffb34970');
                glow.addColorStop(1, '#ff784700');
                context.fillStyle = glow;
                context.fillRect(tipX - 35, tipY - 35, 70, 70);

                context.strokeStyle = '#5c839b';
                context.lineWidth = 4;
                context.beginPath();
                context.moveTo(tipX, 35);
                context.lineTo(tipX, tipY - 100);
                context.stroke();
                const metal = context.createLinearGradient(tipX - 13, 0, tipX + 13, 0);
                metal.addColorStop(0, '#35566c');
                metal.addColorStop(0.4, '#d7e9f3');
                metal.addColorStop(0.65, '#81a5bc');
                metal.addColorStop(1, '#2c4b61');
                context.fillStyle = metal;
                context.fillRect(tipX - 13, tipY - 100, 26, 54);
                context.fillStyle = '#315e7a';
                context.fillRect(tipX - 16, tipY - 87, 32, 9);
                context.fillStyle = metal;
                context.beginPath();
                context.moveTo(tipX - 11, tipY - 46);
                context.lineTo(tipX + 11, tipY - 46);
                context.lineTo(tipX + 4, tipY - 19);
                context.lineTo(tipX - 4, tipY - 19);
                context.closePath();
                context.fill();
                context.strokeStyle = '#fff3c6';
                context.lineWidth = 2;
                context.beginPath();
                context.moveTo(tipX, tipY - 17);
                context.lineTo(tipX, tipY);
                context.stroke();
                context.fillStyle = '#fffbe8';
                context.beginPath();
                context.arc(tipX, tipY, 3.5, 0, Math.PI * 2);
                context.fill();
            }

            // Subtle model bounds and a single progress line.
            context.strokeStyle = '#62c4ef45';
            context.lineWidth = 1;
            context.beginPath();
            context.moveTo(29, 102);
            context.lineTo(29, 88);
            context.lineTo(43, 88);
            context.moveTo(517, 286);
            context.lineTo(531, 286);
            context.lineTo(531, 272);
            context.stroke();
            context.fillStyle = '#24445b';
            context.fillRect(48, 318, 464, 2);
            context.fillStyle = '#94dcff';
            context.fillRect(48, 318, progress * 464, 2);
        };

        const tick = timestamp => {
            if (timestamp - lastUpdate >= 50) {
                advance();
                draw();
                lastUpdate = timestamp;
            }
            frame = requestAnimationFrame(tick);
        };
        const syncPlayback = () => {
            if (frame !== null) cancelAnimationFrame(frame);
            frame = null;
            pause.hidden = motion.matches;
            if (visible && !paused && !motion.matches && !document.hidden) {
                lastUpdate = 0;
                frame = requestAnimationFrame(tick);
            }
        };
        const reset = () => {
            field.fill(0);
            elapsed = 0;
            // A representative static frame also explains the process with motion disabled.
            for (let step = 0; step < 90; step++) advance();
            draw();
        };
        pause.addEventListener('click', () => {
            paused = !paused;
            pause.setAttribute('aria-pressed', String(paused));
            pause.setAttribute('aria-label', paused ? 'Play process animation' : 'Pause process animation');
            pause.textContent = paused ? 'Play ▷' : 'Pause Ⅱ';
            syncPlayback();
        });
        motion.addEventListener('change', () => { reset(); syncPlayback(); });
        document.addEventListener('visibilitychange', syncPlayback);
        const observer = new IntersectionObserver(entries => {
            visible = entries[0].isIntersecting;
            syncPlayback();
        });
        reset();
        observer.observe(visual);
    });
    document.querySelectorAll('[data-ps-scenarios]').forEach(demo => {
        const curves = {
            steady: 'M20 130C85 130 95 78 150 70S240 55 285 52S345 50 380 50',
            responsive: 'M20 130C65 130 75 25 125 30S190 78 240 56S330 50 380 50'
        };
        demo.querySelectorAll('[data-scenario]').forEach(button => button.addEventListener('click', () => {
            demo.querySelectorAll('[data-scenario]').forEach(other => other.setAttribute('aria-pressed', String(other === button)));
            demo.querySelector('.ps-alternative').setAttribute('d', curves[button.dataset.scenario]);
            demo.querySelector('.ps-demo-caption').textContent = button.dataset.scenario === 'steady'
                ? 'Setting A · a smoother illustrative response. No engineering model is running.'
                : 'Setting B · a quicker illustrative response with more overshoot. No engineering model is running.';
        }));
    });
})();
