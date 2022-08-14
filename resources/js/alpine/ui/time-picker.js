export default () => ({
    //0 -> hidden, 1 -> setting hours, 2 -> setting minutes
    timePickerState: 0,

    isMorning: true,

    selectedQuadrant: 0,

    numLabels: 12,

    innerRadius: 0,

    angles: [],

    dragging: false,

    fading: false,

    init: function () {
        const n = this.numLabels;

        var frags = 360 / n;
        for (var i = 0; i <= n; i++) {
            this.angles.push((frags / 180) * i * Math.PI);
        }

        this.$nextTick(() => {
            const el = this.$refs.clock;
            this.innerRadius = el.offsetHeight / 2 - 24;
        });

        this.$watch('timePickerState', (val) => {
            this.$nextTick(() => {
                const el = this.$refs.clock;
                this.innerRadius = el.offsetHeight / 2 - 24;

                if (val == 1) {
                    var hour = this.selectedTime.h;

                    if (hour > 12)
                        this.isMorning = false;

                    hour = hour % 12;

                    this.selectedQuadrant = hour;
                }

                if (val == 2) {
                    var minute = this.selectedTime.m;

                    this.selectedQuadrant = minute;
                }
            });
        });

        //Correct AM/PM for initially parsed time and then watch in case the time is updated from outside of the component

        if (this.selectedTime.h > 11)
            this.isMorning = false;

        this.$watch('selectedTime', (val) => {
            if (val.h > 11)
                this.isMorning = false;
        });
    },

    clock: {

        ['@click'](e) {
            const clickQuadrant = this.getCurrentQuadrant(e);

            this.selectedQuadrant = clickQuadrant;

            this.updateTime(clickQuadrant);
        },

        ['@mousedown']() {
            this.dragging = true;
        },

        ['@mousemove'](e) {
            if (this.dragging) {
                const clickQuadrant = this.getCurrentQuadrant(e);

                this.selectedQuadrant = clickQuadrant;
            }
        },

        ['@mouseup']() {
            this.dragging = false;
        }

    },

    getCurrentQuadrant: function (e) {
        const el = this.$refs.clock;
        const circleRadius = el.offsetHeight / 2;

        const clickPos = {
            x: e.offsetX,
            y: e.offsetY,
        }

        var angleRadians = Math.atan2(clickPos.y - circleRadius, clickPos.x - circleRadius);
        if (angleRadians < 0) {
            angleRadians += 2.0 * Math.PI;
        };

        const angleDeg = Math.trunc((angleRadians * 180) / Math.PI);

        var clickQuadrant = (Math.trunc((angleDeg + 180 / this.numQuadrants) / (360 / this.numQuadrants)) + this.numQuadrants / 3 - (this.numQuadrants / 12)) % this.numQuadrants;

        if (clickQuadrant == this.numQuadrants)
            clickQuadrant = 0;

        return clickQuadrant;
    },

    updateTime: function (value) {
        if (this.timePickerState == 1) {
            if (this.isMorning) {

                this.selectedTime.h = value;
            }
            else {
                value = value + 12;

                this.selectedTime.h = value;

            }

            this.fading = true;

            //Switch to showing the minutes view
            setTimeout(() => {
                this.timePickerState = 2
                this.fading = false;
            }, 150);
        }
        else {
            this.timePickerState = 0;

            if (value >= 0 && value < 60)
                setTimeout(() => { this.selectedTime.m = parseInt(value); }, 150)
        }
    },

    parseHour: function (hour) {
        var hour = this.selectedTime.h;

        if (hour > 11) {
            hour = hour % 12;
        }

        if (hour == 0)
            hour = 12;

        return hour
    },

    setState: function (s) {
        this.fading = true;

        setTimeout(() => {
            this.timePickerState = s;
            this.fading = false;
        }, 150);
    },

    get numQuadrants() {
        return this.timePickerState == 1 ? 12 : 60;
    },

    get labelsContent() {
        return this.timePickerState == 1 ? [12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] : ['00', '05', 10, 15, 20, 25, 30, 35, 40, 45, 50, 55];
    },

    get formattedTime() {
        return this.parseHour() + ':' + String(this.selectedTime.m).padStart(2, '0') + (this.isMorning ? ' AM' : ' PM');
    }

});