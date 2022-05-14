<?php

namespace Yajra\DataTables\Html\Tests;

use Yajra\DataTables\Html\Column;

class ColumnTest extends TestCase
{
    /** @test */
    public function it_can_create_column()
    {
        $column = Column::make('name');

        $this->assertInstanceOf(Column::class, $column);
    }

    /** @test */
    public function it_has_default_properties()
    {
        $column = Column::make('name');

        $this->assertEquals('name', $column->name);
        $this->assertEquals('name', $column->data);
        $this->assertEquals('Name', $column->title);
        $this->assertEquals('', $column->render);
        $this->assertEquals(true, $column->exportable);
        $this->assertEquals(true, $column->printable);
        $this->assertEquals(true, $column->orderable);
        $this->assertEquals(true, $column->searchable);
        $this->assertEquals([], $column->attributes);
        $this->assertEquals('', $column->footer);
    }

    /** @test */
    public function it_can_format_title()
    {
        $this->assertEquals('Title', Column::titleFormat('title'));
    }

    /** @test */
    public function it_can_make_computed_column()
    {
        $column = Column::computed('name');

        $this->assertEquals('name', $column->name);
        $this->assertEquals('name', $column->data);
        $this->assertEquals('Name', $column->title);
        $this->assertEquals('', $column->render);
        $this->assertEquals(true, $column->exportable);
        $this->assertEquals(true, $column->printable);
        $this->assertEquals(false, $column->orderable);
        $this->assertEquals(false, $column->searchable);
        $this->assertEquals([], $column->attributes);
        $this->assertEquals('', $column->footer);
    }


    /** @test */
    public function it_can_make_formatted_column()
    {
        $column = Column::formatted('name');

        $this->assertEquals('name', $column->name);
        $this->assertEquals('name', $column->data);
        $this->assertEquals('Name', $column->title);
        $this->assertEquals('function(data,type,full,meta){return full.name_formatted;}', $column->render);
        $this->assertEquals(true, $column->exportable);
        $this->assertEquals(true, $column->printable);
        $this->assertEquals(true, $column->orderable);
        $this->assertEquals(true, $column->searchable);
        $this->assertEquals([], $column->attributes);
        $this->assertEquals('', $column->footer);
    }

    /** @test */
    public function it_can_make_a_checkbox()
    {
        $column = Column::checkbox('name');

        $this->assertEquals('', $column->name);
        $this->assertEquals('', $column->data);
        $this->assertEquals('name', $column->title);
        $this->assertEquals('', $column->render);
        $this->assertEquals(true, $column->printable);
        $this->assertEquals(false, $column->exportable);
        $this->assertEquals(false, $column->orderable);
        $this->assertEquals(false, $column->searchable);
        $this->assertEquals('select-checkbox', $column->className);
        $this->assertEquals([], $column->attributes);
        $this->assertEquals('', $column->footer);
    }

    /** @test */
    public function it_has_property_setters()
    {
        $column = Column::checkbox('name');

        $column->name('test');
        $this->assertEquals('test', $column->name);

        $column->data('test');
        $this->assertEquals('test', $column->data);

        $column->title('test');
        $this->assertEquals('test', $column->title);

        $column->editField('test');
        $this->assertEquals('test', $column->editField);

        $column->orderData(1);
        $this->assertEquals(1, $column->orderData);

        $column->orderData([1]);
        $this->assertEquals([1], $column->orderData);

        $column->orderDataType('test');
        $this->assertEquals('test', $column->orderDataType);

        $column->orderSequence(['test']);
        $this->assertEquals(['test'], $column->orderSequence);

        $column->cellType('test');
        $this->assertEquals('test', $column->cellType);

        $column->type('test');
        $this->assertEquals('test', $column->type);

        $column->contentPadding('test');
        $this->assertEquals('test', $column->contentPadding);

        $column->createdCell('test');
        $this->assertEquals('test', $column->createdCell);

        $column->titleAttr('test');
        $this->assertEquals('test', $column->titleAttr);

        $column->exportFormat('test');
        $this->assertEquals('test', $column->exportFormat);
    }

    /** @test */
    public function it_can_render_scripts()
    {
        $column = Column::make('name');

        $column->render('test');
        $this->assertEquals('function(data,type,full,meta){return test;}', $column->render);

        $column->render('$.fn.dataTable.render.test');
        $this->assertEquals('$.fn.dataTable.render.test', $column->render);

        $column->renderJs('test');
        $this->assertEquals('$.fn.dataTable.render.test', $column->render);

        $column->renderRaw('test');
        $this->assertEquals('test', $column->render);
    }

    /** @test */
    public function it_allows_orthogonal_data()
    {
        $expected = [
            '_' => 'test',
            'sort' => 'test',
            'filter' => 'test',
            'type' => 'test',
        ];
        $column = Column::make('name')->data($expected);

        $this->assertEquals($expected, $column->data);
    }

    /** @test */
    public function it_has_responsive_priority()
    {
        $column = Column::make('name');
        $column->responsivePriority(1);

        $this->assertEquals(1, $column->responsivePriority);
    }

    /** @test */
    public function it_can_add_class()
    {
        $column = Column::make('name')->className('text-sm');
        $this->assertEquals('text-sm', $column->className);

        $column->addClass('font-bold');
        $this->assertEquals('text-sm font-bold', $column->className);
    }


}
