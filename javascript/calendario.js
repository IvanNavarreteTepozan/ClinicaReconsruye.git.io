
        document.addEventListener('DOMContentLoaded', function() {
            // Variables de estado
            let currentDate = new Date();
            let selectedDate = null;
            let selectedTime = null;
            
            // Elementos del DOM
            const monthYearElement = document.getElementById('month-year');
            const daysElement = document.getElementById('days');
            const prevMonthButton = document.getElementById('prev-month');
            const nextMonthButton = document.getElementById('next-month');
            const timeOptionsElement = document.getElementById('time-options');
            const fechaConsultaInput = document.getElementById('fecha_consulta');
            const form = document.getElementById('Form_Cita');
            
            // Generar horas de 9:00 a 11:30 en intervalos de 30 minutos
            const generateTimeOptions = () => {
                timeOptionsElement.innerHTML = '';
                const startHour = 9;
                const endHour = 11;
                
                for (let hour = startHour; hour <= endHour; hour++) {
                    for (let minute = 0; minute < 60; minute += 30) {
                        if (hour === endHour && minute === 30) break; // No pasar de 11:30
                        
                        const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                        const timeOption = document.createElement('div');
                        timeOption.className = 'time-option';
                        timeOption.textContent = timeString;
                        timeOption.dataset.time = timeString;
                        
                        timeOption.addEventListener('click', () => {
                            document.querySelectorAll('.time-option').forEach(opt => {
                                opt.classList.remove('selected');
                            });
                            timeOption.classList.add('selected');
                            selectedTime = timeString;
                            updateHiddenInput();
                        });
                        
                        timeOptionsElement.appendChild(timeOption);
                    }
                }
            };
            
            // Renderizar el calendario
            const renderCalendar = () => {
                // Actualizar el encabezado del mes/año
                const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", 
                                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
                monthYearElement.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
                
                // Limpiar días anteriores
                daysElement.innerHTML = '';
                
                // Obtener primer día del mes y último día del mes
                const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
                const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
                
                // Obtener día de la semana del primer día (0-6, donde 0 es domingo)
                const firstDayOfWeek = firstDay.getDay();
                // Ajustar para que la semana comience en lunes (1)
                const startingDay = firstDayOfWeek === 0 ? 6 : firstDayOfWeek - 1;
                
                // Agregar días vacíos si el mes no comienza en lunes
                for (let i = 0; i < startingDay; i++) {
                    const emptyDay = document.createElement('div');
                    emptyDay.className = 'day disabled';
                    daysElement.appendChild(emptyDay);
                }
                
                // Agregar días del mes
                for (let day = 1; day <= lastDay.getDate(); day++) {
                    const dayElement = document.createElement('div');
                    dayElement.className = 'day';
                    dayElement.textContent = day;
                    
                    const date = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);
                    dayElement.dataset.date = date.toISOString().split('T')[0];
                    
                    // Resaltar día seleccionado
                    if (selectedDate && date.toDateString() === selectedDate.toDateString()) {
                        dayElement.classList.add('selected');
                    }
                    
                    dayElement.addEventListener('click', () => {
                        document.querySelectorAll('.day').forEach(d => {
                            d.classList.remove('selected');
                        });
                        dayElement.classList.add('selected');
                        selectedDate = date;
                        updateHiddenInput();
                    });
                    
                    daysElement.appendChild(dayElement);
                }
            };
            
            // Actualizar el input hidden con la fecha y hora seleccionadas
            const updateHiddenInput = () => {
                if (selectedDate && selectedTime) {
                    const dateStr = selectedDate.toISOString().split('T')[0];
                    const result = `${dateStr}T${selectedTime}`;
                    fechaConsultaInput.value = result;
                }
            };
            
            // Manejar botones de navegación
            prevMonthButton.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });
            
            nextMonthButton.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });
            
            // Validar antes de enviar el formulario
            form.addEventListener('submit', function(e) {
                if (!selectedDate || !selectedTime) {
                    e.preventDefault();
                    alert('Por favor, selecciona una fecha y una hora');
                }
            });
            
            // Manejar reset del formulario
            form.addEventListener('reset', function() {
                selectedDate = null;
                selectedTime = null;
                document.querySelectorAll('.day.selected, .time-option.selected').forEach(el => {
                    el.classList.remove('selected');
                });
                fechaConsultaInput.value = '';
                currentDate = new Date();
                renderCalendar();
            });
            
            // Inicializar
            generateTimeOptions();
            renderCalendar();
        });
