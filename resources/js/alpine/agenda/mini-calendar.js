import dayjs from 'dayjs';

export default () => ({
    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],

    init: function () {
        this.currentDate = new dayjs(this.$parent.date);
        this.currentDate = this.currentDate.startOf('month');
    },

    prevYear: function () {
        this.currentDate = this.currentDate.subtract(1, 'year');
    },

    prevMonth: function () {
        this.currentDate = this.currentDate.subtract(1, 'month');
    },

    nextMonth: function () {
        this.currentDate = this.currentDate.add(1, 'month');
    },

    nextYear: function () {
        this.currentDate = this.currentDate.add(1, 'year');
    },

    isToday: function (date) {
        return (
            this.currentDate.format('YYYY-MM') ==
                new dayjs().format('YYYY-MM') &&
            date == new dayjs().date() &&
            !this.isActiveDate(date)
        );
    },

    isActiveDate: function (date) {
        return (
            this.$parent.date.format('YYYY-MM') ==
                this.currentDate.format('YYYY-MM') &&
            this.$parent.date.date() == date
        );
    },

    changeDate: function (day) {
        this.setDate(new dayjs(this.currentDate).date(day));
    },

    //Getters
    get monthDays() {
        return this.currentDate.endOf('month').date();
    },

    get startingBlankDays() {
        const firstDayOfMonth = this.currentDate.day();
        var numberOfStartingBlanks = 0;
        for (var i = 0; i < firstDayOfMonth; i++) {
            numberOfStartingBlanks += 1;
        }

        const prevMonthNumberOfDays = this.currentDate
            .subtract(1, 'month')
            .endOf('month')
            .date();
        var blankDays = [];

        for (var i = 0; i < numberOfStartingBlanks; i++) {
            blankDays.push(prevMonthNumberOfDays - i);
        }

        return blankDays.sort((a, b) => a - b);
    },

    get endingBlankDays() {
        const unfilledSlots =
            7 - ((this.monthDays + this.startingBlankDays.length) % 7);
        var blankDays = [];

        if (unfilledSlots != 0) {
            for (var i = 1; i <= unfilledSlots; i++) {
                blankDays.push(i);
            }
        }
        return blankDays;
    },

    get monthYear() {
        return this.currentDate.format('MMMM YYYY');
    },
});
