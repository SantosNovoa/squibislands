<script>
	function LiveClockJS() {
		// Force Eastern Time regardless of the user’s system timezone
		let options = {
			hour: '2-digit',
			minute: '2-digit',
			second: '2-digit',
			hour12: true,
			timeZone: 'America/New_York'
		};

		let formatter = new Intl.DateTimeFormat([], options);
		let parts = formatter.formatToParts(new Date());

		let time = '';
		let ampm = '';

		parts.forEach(p => {
			if (p.type === 'hour' || p.type === 'minute' || p.type === 'second') {
				time += (time ? ':' : '') + p.value;
			}
			if (p.type === 'dayPeriod') {
				ampm = p.value.toUpperCase();
			}
		});

		$(".time").html(time);
		$(".am-pm").html(ampm);

		setTimeout(LiveClockJS, 1000);
	}

LiveClockJS();

	LiveClockJS();

	function LiveClockJS_Determine(offset){
		let date = new Date();
		date.setUTCMinutes(date.getUTCMinutes() + parseInt(offset));

		let h = date.getUTCHours(); // 0–23
		let m = date.getUTCMinutes();
		let s = date.getUTCSeconds();

		// Convert to 12-hour format
		let ampm = h >= 12 ? "PM" : "AM";
		h = h % 12;
		h = h ? h : 12; // 0 becomes 12 for 12-hour clock

		// Zero-pad
		h = (h < 10) ? "0" + h : h;
		m = (m < 10) ? "0" + m : m;
		s = (s < 10) ? "0" + s : s;

		let time = h + ":" + m + ":" + s;

		return { time, ampm };
	}

</script>