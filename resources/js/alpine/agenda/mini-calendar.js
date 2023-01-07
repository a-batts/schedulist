export default () => ({
    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],

    init: function () {
        this.currentDate = new Date(this.$parent.date.valueOf());
        this.currentDate.setDate(1);
    },

    prevYear: function () {
        const newDate = new Date(this.currentDate.valueOf());
        newDate.setFullYear(newDate.getFullYear() - 1);
        this.currentDate = newDate;
    },

    prevMonth: function () {
        const newDate = new Date(this.currentDate.valueOf());
        newDate.setMonth(newDate.getMonth() - 1);
        this.currentDate = newDate;
    },

    nextMonth: function () {
        const newDate = new Date(this.currentDate.valueOf());
        newDate.setMonth(newDate.getMonth() + 1);
        this.currentDate = newDate;
    },

    nextYear: function () {
        const newDate = new Date(this.currentDate.valueOf());
        newDate.setFullYear(newDate.getFullYear() + 1);
        this.currentDate = newDate;
    },

    isToday: function (day) {
        const today = new Date();
        return (
            this.currentDate.getFullYear() == today.getFullYear() &&
            this.currentDate.getMonth() == today.getMonth() &&
            today.getDate() == day &&
            !this.isActiveDate(day)
        );
    },

    isActiveDate: function (day) {
        const activeDate = this.$parent.date;
        return (
            this.currentDate.getFullYear() == activeDate.getFullYear() &&
            this.currentDate.getMonth() == activeDate.getMonth() &&
            activeDate.getDate() == day
        );
    },

    changeDate: function (day) {
        const newDate = new Date(this.date.getTime());
        newDate.setDate(parseInt(day));
        newDate.setFullYear(this.currentDate.getFullYear());
        newDate.setMonth(this.currentDate.getMonth());

        this.setDate(newDate);
    },

    //Getters

    get monthDays() {
        const month = this.currentDate.getMonth();

        return new Date(this.currentDate.getFullYear(), month + 1, 0).getDate();
    },

    get startingBlankDays() {
        const firstDayOfMonth = new Date(
            this.currentDate.getFullYear(),
            this.currentDate.getMonth(),
            1
        ).getUTCDay();
        var numberOfStartingBlanks = 0;

        for (var i = 0; i < firstDayOfMonth; i++) {
            numberOfStartingBlanks += 1;
        }

        const prevMonth = new Date(this.currentDate.valueOf());
        prevMonth.setMonth(this.currentDate.getMonth() - 1);
        prevMonth.setDate(1);
        const prevMonthNumberOfDays = new Date(
            prevMonth.getFullYear(),
            prevMonth.getMonth() + 1,
            0
        ).getDate();

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
        return (
            this.currentDate.toLocaleString('default', { month: 'long' }) +
            ' ' +
            this.currentDate.getFullYear()
        );
    },
});
