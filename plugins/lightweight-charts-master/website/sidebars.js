// @ts-check

/** @type {import('@docusaurus/plugin-content-docs').SidebarsConfig} */
const sidebars = {
	docsSidebar: [
		'intro',
		'series-types',
		'price-scale',
		'time-scale',
		'time-zones',
		{
			Migrations: [
				{
					type: 'autogenerated',
					dirName: 'migrations',
				},
			],
		},
		{
			type: 'doc',
			id: 'ios',
			label: 'iOS',
		},
		{
			type: 'doc',
			id: 'android',
			label: 'Android',
		},
	],
	apiSidebar: [{
		type: 'autogenerated',
		dirName: 'api',
	}],
	tutorialsSidebar: [{
		type: 'autogenerated',
		dirName: 'tutorials',
	}],
};

module.exports = sidebars;
